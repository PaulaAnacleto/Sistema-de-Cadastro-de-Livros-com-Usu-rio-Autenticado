<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../Config/Database.php';

class DatabaseTest extends TestCase {
    public function testDatabaseConnection() {
        $db = new Database();
        $conn = $db->getConnection();
        $this->assertInstanceOf(PDO::class, $conn);
    }
}
