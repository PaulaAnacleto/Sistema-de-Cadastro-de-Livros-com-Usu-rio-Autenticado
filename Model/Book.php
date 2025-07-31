<?php

namespace Model;

use PDO;

// Classe Book para gerenciar livros no sistema
class Book
{
    private PDO $db;

    // Constantes de status do livro
    public const STATUS_READ = 'Lido';
    public const STATUS_READING = 'Lendo';
    public const STATUS_WANT_TO_READ = 'Desejo Ler';
    public const STATUS_ABANDONED = 'Abandonado';

    // Lista de status válidos
    public const VALID_STATUSES = [
        self::STATUS_READ,
        self::STATUS_READING,
        self::STATUS_WANT_TO_READ,
        self::STATUS_ABANDONED
    ];

    // Construtor: inicializa conexão com banco
    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    // Busca todos os livros de um usuário
    public function findByUser(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id_user = :user_id ORDER BY created_at DESC");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Busca um livro específico de um usuário
    public function findByUserAndId(int $userId, int $bookId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = :id AND id_user = :user_id");
        $stmt->bindParam(':id', $bookId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result ?: null;
    }

    // Cria um novo livro
    public function createBook(array $bookData): bool
    {
        $bookData['created_at'] = date('Y-m-d H:i:s');
        
        // Valida status
        if (!in_array($bookData['status'], self::VALID_STATUSES)) {
            $bookData['status'] = self::STATUS_WANT_TO_READ;
        }
        
        $columns = implode(', ', array_keys($bookData));
        $placeholders = ':' . implode(', :', array_keys($bookData));
        
        $sql = "INSERT INTO books ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        
        // Adiciona valores
        foreach ($bookData as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        
        return $stmt->execute();
    }

    // Atualiza um livro existente
    public function updateBook(int $bookId, int $userId, array $data): bool
    {
        // Valida status se informado
        if (isset($data['status']) && !in_array($data['status'], self::VALID_STATUSES)) {
            return false;
        }

        // Verifica se o livro pertence ao usuário
        if (!$this->findByUserAndId($userId, $bookId)) {
            return false;
        }

        // Monta cláusula SET
        $setParts = [];
        foreach (array_keys($data) as $key) {
            $setParts[] = "{$key} = :{$key}";
        }
        $setClause = implode(', ', $setParts);
        
        $sql = "UPDATE books SET {$setClause} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindParam(':id', $bookId, PDO::PARAM_INT);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        
        return $stmt->execute();
    }

    // Exclui um livro
    public function deleteBook(int $bookId, int $userId): bool
    {
        // Verifica se o livro pertence ao usuário
        if (!$this->findByUserAndId($userId, $bookId)) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        $stmt->bindParam(':id', $bookId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Busca livros por status
    public function findByStatus(int $userId, string $status): array
    {
        if (!in_array($status, self::VALID_STATUSES)) {
            return [];
        }

        $stmt = $this->db->prepare("SELECT * FROM books WHERE id_user = :user_id AND status = :status ORDER BY created_at DESC");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Pesquisa livros pelo termo informado
    public function searchBooks(int $userId, string $searchTerm): array
    {
        $searchTerm = "%{$searchTerm}%";
        $stmt = $this->db->prepare("
            SELECT * FROM books 
            WHERE id_user = :user_id 
            AND (title LIKE :search OR author LIKE :search OR genre LIKE :search OR publisher LIKE :search)
            ORDER BY created_at DESC
        ");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Retorna quantidade de livros por gênero
    public function getBooksByGenre(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT genre, COUNT(*) as count 
            FROM books 
            WHERE id_user = :user_id 
            GROUP BY genre 
            ORDER BY count DESC
        ");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Retorna livros mais recentes
    public function getRecentBooks(int $userId, int $limit = 5): array
    {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id_user = :user_id ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Verifica se o status é válido
    public function isValidStatus(string $status): bool
    {
        return in_array($status, self::VALID_STATUSES);
    }
}

