<?php

namespace Controller;

use Model\User;

class AuthController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showLogin(): void
    {
        if ($this->isLoggedIn()) {
            header('Location: index.php?action=dashboard');
            exit;
        }

        $error = $this->getFlashMessage('error');
        $success = $this->getFlashMessage('success');
        
        include 'View/login.php';
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=login');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $this->setFlashMessage('error', 'Email e senha são obrigatórios');
            header('Location: index.php?action=login');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->setFlashMessage('error', 'Email inválido');
            header('Location: index.php?action=login');
            exit;
        }

        $user = $this->userModel->validateLogin($email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_fullname'];
            $this->setFlashMessage('success', 'Login realizado com sucesso!');
            header('Location: index.php?action=dashboard');
            exit;
        } else {
            $this->setFlashMessage('error', 'Email ou senha incorretos');
            header('Location: index.php?action=login');
            exit;
        }
    }

    public function showRegister(): void
    {
        if ($this->isLoggedIn()) {
            header('Location: index.php?action=dashboard');
            exit;
        }

        $error = $this->getFlashMessage('error');
        $success = $this->getFlashMessage('success');
        
        include 'View/cadastro-usuario.php';
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=register');
            exit;
        }

        $userData = [
            'user_fullname' => trim($_POST['user_fullname'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'confirm_password' => $_POST['confirm_password'] ?? ''
        ];

        // Validações
        if (empty($userData['user_fullname']) || empty($userData['email']) || 
            empty($userData['password']) || empty($userData['confirm_password'])) {
            $this->setFlashMessage('error', 'Todos os campos são obrigatórios');
            header('Location: index.php?action=register');
            exit;
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            $this->setFlashMessage('error', 'Email inválido');
            header('Location: index.php?action=register');
            exit;
        }

        if ($userData['password'] !== $userData['confirm_password']) {
            $this->setFlashMessage('error', 'As senhas não coincidem');
            header('Location: index.php?action=register');
            exit;
        }

        if (strlen($userData['password']) < 6) {
            $this->setFlashMessage('error', 'A senha deve ter pelo menos 6 caracteres');
            header('Location: index.php?action=register');
            exit;
        }

        if ($this->userModel->emailExists($userData['email'])) {
            $this->setFlashMessage('error', 'Este email já está cadastrado');
            header('Location: index.php?action=register');
            exit;
        }

        // Remove confirm_password before saving
        unset($userData['confirm_password']);

        if ($this->userModel->createUser($userData)) {
            $this->setFlashMessage('success', 'Usuário cadastrado com sucesso! Faça login para continuar.');
            header('Location: index.php?action=login');
            exit;
        } else {
            $this->setFlashMessage('error', 'Erro ao cadastrar usuário. Tente novamente.');
            header('Location: index.php?action=register');
            exit;
        }
    }

    public function logout(): void
    {
        session_destroy();
        $this->setFlashMessage('success', 'Logout realizado com sucesso!');
        header('Location: index.php?action=login');
        exit;
    }

    private function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
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

    private function requireAuth(): void
    {
        if (!$this->isLoggedIn()) {
            $this->setFlashMessage('error', 'Você precisa estar logado para acessar esta página');
            header('Location: index.php?action=login');
            exit;
        }
    }
}


