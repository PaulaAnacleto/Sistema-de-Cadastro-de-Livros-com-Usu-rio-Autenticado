<?php

namespace Controller;

use Model\Book;
use Model\User;

class BookController
{
    private Book $bookModel;
    private User $userModel;

    public function __construct()
    {
        $this->bookModel = new Book();
        $this->userModel = new User();
        $this->requireAuth();
    }

    public function dashboard(): void
    {
        $userId = $_SESSION['user_id'];
        $userStats = $this->userModel->getUserStats($userId);
        $recentBooks = $this->bookModel->getRecentBooks($userId, 5);
        $booksByGenre = $this->bookModel->getBooksByGenre($userId);
        
        $success = $this->getFlashMessage('success');
        $error = $this->getFlashMessage('error');

        $user_name = $_SESSION['user_name'];
        $stats = $userStats;
        $recent_books = $recentBooks;
        $books_by_genre = $booksByGenre;

        include 'View/dashboard.php';
    }

    public function myBooks(): void
    {
        $userId = $_SESSION['user_id'];
        $status = $_GET['status'] ?? '';
        $search = $_GET['search'] ?? '';

        if (!empty($search)) {
            $books = $this->bookModel->searchBooks($userId, $search);
        } elseif (!empty($status) && $this->bookModel->isValidStatus($status)) {
            $books = $this->bookModel->findByStatus($userId, $status);
        } else {
            $books = $this->bookModel->findByUser($userId);
        }

        $success = $this->getFlashMessage('success');
        $error = $this->getFlashMessage('error');
        $current_status = $status;
        $search_term = $search;
        $valid_statuses = Book::VALID_STATUSES;

        include 'View/meus-livros.php';
    }

    public function showAddBook(): void
    {
        $error = $this->getFlashMessage('error');
        $success = $this->getFlashMessage('success');
        $valid_statuses = Book::VALID_STATUSES;

        include 'View/cadastro-livro.php';
    }

    public function addBook(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=add_book');
            exit;
        }

        $bookData = [
            'title' => trim($_POST['title'] ?? ''),
            'year_public' => trim($_POST['year_public'] ?? ''),
            'author' => trim($_POST['author'] ?? ''),
            'publisher' => trim($_POST['publisher'] ?? ''),
            'isbn' => trim($_POST['isbn'] ?? ''),
            'genre' => trim($_POST['genre'] ?? ''),
            'status' => $_POST['status'] ?? Book::STATUS_WANT_TO_READ,
            'description' => trim($_POST['description'] ?? ''),
            'id_user' => $_SESSION['user_id']
        ];

        // Validações básicas
        if (empty($bookData['title']) || empty($bookData['author']) || empty($bookData['genre'])) {
            $this->setFlashMessage('error', 'Título, autor e gênero são obrigatórios');
            header('Location: index.php?action=add_book');
            exit;
        }

        // Validate year if provided
        if (!empty($bookData['year_public']) && (!is_numeric($bookData['year_public']) || $bookData['year_public'] < 1000 || $bookData['year_public'] > date('Y'))) {
            $this->setFlashMessage('error', 'Ano de publicação inválido');
            header('Location: index.php?action=add_book');
            exit;
        }

        // Validate status
        if (!$this->bookModel->isValidStatus($bookData['status'])) {
            $bookData['status'] = Book::STATUS_WANT_TO_READ;
        }

        if ($this->bookModel->createBook($bookData)) {
            $this->setFlashMessage('success', 'Livro cadastrado com sucesso!');
            header('Location: index.php?action=my_books');
            exit;
        } else {
            $this->setFlashMessage('error', 'Erro ao cadastrar livro. Tente novamente.');
            header('Location: index.php?action=add_book');
            exit;
        }
    }

    public function showEditBook(): void
    {
        $bookId = (int)($_GET['id'] ?? 0);
        $userId = $_SESSION['user_id'];

        $book = $this->bookModel->findByUserAndId($userId, $bookId);

        if (!$book) {
            $this->setFlashMessage('error', 'Livro não encontrado');
            header('Location: index.php?action=my_books');
            exit;
        }

        $error = $this->getFlashMessage('error');
        $success = $this->getFlashMessage('success');
        $valid_statuses = Book::VALID_STATUSES;

        include 'View/editar-livro.php';
    }

    public function editBook(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=my_books');
            exit;
        }

        $bookId = (int)($_POST['id'] ?? 0);
        $userId = $_SESSION['user_id'];

        $bookData = [
            'title' => trim($_POST['title'] ?? ''),
            'year_public' => trim($_POST['year_public'] ?? ''),
            'author' => trim($_POST['author'] ?? ''),
            'publisher' => trim($_POST['publisher'] ?? ''),
            'isbn' => trim($_POST['isbn'] ?? ''),
            'genre' => trim($_POST['genre'] ?? ''),
            'status' => $_POST['status'] ?? Book::STATUS_WANT_TO_READ,
            'description' => trim($_POST['description'] ?? '')
        ];

        // Validações básicas
        if (empty($bookData['title']) || empty($bookData['author']) || empty($bookData['genre'])) {
            $this->setFlashMessage('error', 'Título, autor e gênero são obrigatórios');
            header('Location: index.php?action=edit_book&id=' . $bookId);
            exit;
        }

        // Validate year if provided
        if (!empty($bookData['year_public']) && (!is_numeric($bookData['year_public']) || $bookData['year_public'] < 1000 || $bookData['year_public'] > date('Y'))) {
            $this->setFlashMessage('error', 'Ano de publicação inválido');
            header('Location: index.php?action=edit_book&id=' . $bookId);
            exit;
        }

        // Validate status
        if (!$this->bookModel->isValidStatus($bookData['status'])) {
            $this->setFlashMessage('error', 'Status inválido');
            header('Location: index.php?action=edit_book&id=' . $bookId);
            exit;
        }

        if ($this->bookModel->updateBook($bookId, $userId, $bookData)) {
            $this->setFlashMessage('success', 'Livro atualizado com sucesso!');
            header('Location: index.php?action=my_books');
            exit;
        } else {
            $this->setFlashMessage('error', 'Erro ao atualizar livro. Tente novamente.');
            header('Location: index.php?action=edit_book&id=' . $bookId);
            exit;
        }
    }

    public function showBookDetails(): void
    {
        $bookId = (int)($_GET['id'] ?? 0);
        $userId = $_SESSION['user_id'];

        $book = $this->bookModel->findByUserAndId($userId, $bookId);

        if (!$book) {
            $this->setFlashMessage('error', 'Livro não encontrado');
            header('Location: index.php?action=my_books');
            exit;
        }

        include 'View/detalhes-livro.php';
    }

    public function deleteBook(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=my_books');
            exit;
        }

        $bookId = (int)($_POST['id'] ?? 0);
        $userId = $_SESSION['user_id'];

        if ($this->bookModel->deleteBook($bookId, $userId)) {
            $this->setFlashMessage('success', 'Livro excluído com sucesso!');
        } else {
            $this->setFlashMessage('error', 'Erro ao excluir livro');
        }

        header('Location: index.php?action=my_books');
        exit;
    }

    private function requireAuth(): void
    {
        if (!isset($_SESSION['user_id'])) {
            $this->setFlashMessage('error', 'Você precisa estar logado para acessar esta página');
            header('Location: index.php?action=login');
            exit;
        }
    }

    private function setFlashMessage(string $type, string $message): void
    {
        $_SESSION['flash_message'][$type] = $message;
    }

    private function getFlashMessage(string $type): ?string
    {
        if (isset($_SESSION['flash_message'][$type])) {
            $message = $_SESSION['flash_message'][$type];
            unset($_SESSION['flash_message'][$type]);
            return $message;
        }
        return null;
    }
}