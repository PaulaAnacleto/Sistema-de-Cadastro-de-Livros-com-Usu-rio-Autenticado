<?php

namespace Model;

use PDO;

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function createUser(array $userData): bool
    {
        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        $userData['created_at'] = date('Y-m-d H:i:s');
        
        $columns = implode(', ', array_keys($userData));
        $placeholders = ':' . implode(', :', array_keys($userData));
        
        $sql = "INSERT INTO user ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        
        foreach ($userData as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        
        return $stmt->execute();
    }

    public function validateLogin(string $email, string $password): ?array
    {
        $user = $this->findByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {
            // Remove password from returned data for security
            unset($user['password']);
            return $user;
        }
        
        return null;
    }

    public function emailExists(string $email): bool
    {
        return $this->findByEmail($email) !== null;
    }

    public function updateProfile(int $userId, array $data): bool
    {
        // Remove password from data if it's empty
        if (isset($data['password']) && empty($data['password'])) {
            unset($data['password']);
        } else if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $setParts = [];
        foreach (array_keys($data) as $key) {
            $setParts[] = "{$key} = :{$key}";
        }
        $setClause = implode(', ', $setParts);
        
        $sql = "UPDATE user SET {$setClause} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        
        return $stmt->execute();
    }

    public function getUserStats(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT 
                COUNT(*) as total_books,
                SUM(CASE WHEN status = 'Lido' THEN 1 ELSE 0 END) as books_read,
                SUM(CASE WHEN status = 'Lendo' THEN 1 ELSE 0 END) as books_reading,
                SUM(CASE WHEN status = 'Desejo Ler' THEN 1 ELSE 0 END) as books_want_to_read,
                SUM(CASE WHEN status = 'Abandonado' THEN 1 ELSE 0 END) as books_abandoned
            FROM books 
            WHERE id_user = :user_id
        ");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch() ?: [
            'total_books' => 0,
            'books_read' => 0,
            'books_reading' => 0,
            'books_want_to_read' => 0,
            'books_abandoned' => 0
        ];
    }
}

