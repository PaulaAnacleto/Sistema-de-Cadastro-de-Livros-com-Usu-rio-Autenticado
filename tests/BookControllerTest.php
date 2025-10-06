<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../Controller/BookController.php';
require_once __DIR__ . '/../Model/Book.php';

class BookControllerTest extends TestCase {
    private $controller;

    protected function setUp(): void {
        $this->controller = new BookController();
    }

    public function testAddBook() {
        $result = $this->controller->addBook("O Cortiço", "Aluísio Azevedo", "Realismo");
        $this->assertTrue($result);
    }
}
