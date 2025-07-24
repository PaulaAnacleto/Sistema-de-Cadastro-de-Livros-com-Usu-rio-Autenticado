<?php

namespace Model;

use PDO;
use PDOException;

class Connection
{
    private static ?PDO $instance = null;

    private function __construct()
    {
        // Private constructor to prevent direct instantiation
    }

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            require_once __DIR__ . '/../Config/configuration.php';
            
            $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$instance = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return self::$instance;
    }
}

