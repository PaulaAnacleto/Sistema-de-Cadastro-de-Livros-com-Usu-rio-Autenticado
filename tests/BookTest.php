<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../Model/Book.php';

class BookTest extends TestCase {
    private $book;

    protected function setUp(): void {
        $this->book = new Book();
    }

    public function testCreateBook() {
        $result = $this->book->createBook("Dom Casmurro", "Machado de Assis", "Romance");
        $this->assertTrue($result);
    }

    public function testGetBooksReturnsArray() {
        $books = $this->book->getBooks();
        $this->assertIsArray($books);
    }

    public function testUpdateBook() {
        $result = $this->book->updateBook(1, "Dom Casmurro", "Machado de Assis", "Clássico");
        $this->assertTrue($result);
    }

    public function testDeleteBook() {
        $result = $this->book->deleteBook(1);
        $this->assertTrue($result);
    }
}
