<?php

use PHPUnit\Framework\TestCase;
use Model\Book;

class BookTest extends TestCase {
    
    private $bookModel;
    private $mockDb;
    
    protected function setUp(): void {
        // Cria um mock da classe Book
        $this->bookModel = $this->getMockBuilder(Book::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'findByUser', 
                'findByUserAndId', 
                'createBook', 
                'updateBook', 
                'deleteBook', 
                'findByStatus', 
                'searchBooks', 
                'getBooksByGenre', 
                'getRecentBooks'
            ])
            ->getMock();
    }

    // Teste: Verificar se é possível criar um livro com dados válidos
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_create_book_with_valid_data() {
        $bookData = [
            'title' => 'Clean Code',
            'year_public' => '2008',
            'author' => 'Robert C. Martin',
            'publisher' => 'Prentice Hall',
            'isbn' => '9780132350884',
            'genre' => 'Tecnologia',
            'status' => Book::STATUS_READ,
            'description' => 'Um livro sobre boas práticas de programação',
            'id_user' => 1
        ];

        $this->bookModel->expects($this->once())
            ->method('createBook')
            ->with($this->equalTo($bookData))
            ->willReturn(true);

        $result = $this->bookModel->createBook($bookData);
        $this->assertTrue($result);
    }

    // Teste: Verificar se é possível buscar todos os livros de um usuário
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_find_books_by_user() {
        $userId = 1;
        $expectedBooks = [
            [
                'id' => 1,
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'genre' => 'Tecnologia',
                'status' => Book::STATUS_READ,
                'id_user' => 1
            ],
            [
                'id' => 2,
                'title' => 'Design Patterns',
                'author' => 'Gang of Four',
                'genre' => 'Tecnologia',
                'status' => Book::STATUS_READING,
                'id_user' => 1
            ]
        ];

        $this->bookModel->expects($this->once())
            ->method('findByUser')
            ->with($this->equalTo($userId))
            ->willReturn($expectedBooks);

        $result = $this->bookModel->findByUser($userId);
        
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertEquals('Clean Code', $result[0]['title']);
    }

    // Teste: Verificar se é possível buscar um livro específico por ID e usuário
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_find_book_by_user_and_id() {
        $userId = 1;
        $bookId = 1;
        $expectedBook = [
            'id' => 1,
            'title' => 'Clean Code',
            'author' => 'Robert C. Martin',
            'genre' => 'Tecnologia',
            'status' => Book::STATUS_READ,
            'id_user' => 1
        ];

        $this->bookModel->expects($this->once())
            ->method('findByUserAndId')
            ->with($this->equalTo($userId), $this->equalTo($bookId))
            ->willReturn($expectedBook);

        $result = $this->bookModel->findByUserAndId($userId, $bookId);
        
        $this->assertNotNull($result);
        $this->assertEquals('Clean Code', $result['title']);
        $this->assertEquals(1, $result['id_user']);
    }

    // Teste: Verificar se retorna null quando livro não é encontrado
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_return_null_when_book_not_found() {
        $userId = 1;
        $bookId = 999;

        $this->bookModel->expects($this->once())
            ->method('findByUserAndId')
            ->with($this->equalTo($userId), $this->equalTo($bookId))
            ->willReturn(null);

        $result = $this->bookModel->findByUserAndId($userId, $bookId);
        
        $this->assertNull($result);
    }

    // Teste: Verificar se é possível atualizar um livro
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_update_book() {
        $bookId = 1;
        $userId = 1;
        $updateData = [
            'title' => 'Clean Code - Updated',
            'status' => Book::STATUS_READ
        ];

        $this->bookModel->expects($this->once())
            ->method('updateBook')
            ->with($this->equalTo($bookId), $this->equalTo($userId), $this->equalTo($updateData))
            ->willReturn(true);

        $result = $this->bookModel->updateBook($bookId, $userId, $updateData);
        
        $this->assertTrue($result);
    }

    // Teste: Verificar se atualização falha com status inválido
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_fail_to_update_book_with_invalid_status() {
        $bookId = 1;
        $userId = 1;
        $updateData = [
            'title' => 'Clean Code',
            'status' => 'Status Inválido'
        ];

        $this->bookModel->expects($this->once())
            ->method('updateBook')
            ->with($this->equalTo($bookId), $this->equalTo($userId), $this->equalTo($updateData))
            ->willReturn(false);

        $result = $this->bookModel->updateBook($bookId, $userId, $updateData);
        
        $this->assertFalse($result);
    }

    // Teste: Verificar se é possível excluir um livro
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_delete_book() {
        $bookId = 1;
        $userId = 1;

        $this->bookModel->expects($this->once())
            ->method('deleteBook')
            ->with($this->equalTo($bookId), $this->equalTo($userId))
            ->willReturn(true);

        $result = $this->bookModel->deleteBook($bookId, $userId);
        
        $this->assertTrue($result);
    }

    // Teste: Verificar se exclusão falha quando livro não pertence ao usuário
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_fail_to_delete_book_when_not_owned_by_user() {
        $bookId = 1;
        $userId = 2;

        $this->bookModel->expects($this->once())
            ->method('deleteBook')
            ->with($this->equalTo($bookId), $this->equalTo($userId))
            ->willReturn(false);

        $result = $this->bookModel->deleteBook($bookId, $userId);
        
        $this->assertFalse($result);
    }

    // Teste: Verificar se é possível buscar livros por status
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_find_books_by_status() {
        $userId = 1;
        $status = Book::STATUS_READ;
        $expectedBooks = [
            [
                'id' => 1,
                'title' => 'Clean Code',
                'status' => Book::STATUS_READ,
                'id_user' => 1
            ]
        ];

        $this->bookModel->expects($this->once())
            ->method('findByStatus')
            ->with($this->equalTo($userId), $this->equalTo($status))
            ->willReturn($expectedBooks);

        $result = $this->bookModel->findByStatus($userId, $status);
        
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertEquals(Book::STATUS_READ, $result[0]['status']);
    }

    // Teste: Verificar se retorna array vazio para status inválido
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_return_empty_array_for_invalid_status() {
        $userId = 1;
        $status = 'Status Inválido';

        $this->bookModel->expects($this->once())
            ->method('findByStatus')
            ->with($this->equalTo($userId), $this->equalTo($status))
            ->willReturn([]);

        $result = $this->bookModel->findByStatus($userId, $status);
        
        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    // Teste: Verificar se é possível pesquisar livros por termo
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_search_books() {
        $userId = 1;
        $searchTerm = 'Clean';
        $expectedBooks = [
            [
                'id' => 1,
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'id_user' => 1
            ]
        ];

        $this->bookModel->expects($this->once())
            ->method('searchBooks')
            ->with($this->equalTo($userId), $this->equalTo($searchTerm))
            ->willReturn($expectedBooks);

        $result = $this->bookModel->searchBooks($userId, $searchTerm);
        
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertStringContainsString('Clean', $result[0]['title']);
    }

    // Teste: Verificar se é possível obter livros por gênero
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_get_books_by_genre() {
        $userId = 1;
        $expectedGenres = [
            ['genre' => 'Tecnologia', 'count' => 5],
            ['genre' => 'Ficção', 'count' => 3]
        ];

        $this->bookModel->expects($this->once())
            ->method('getBooksByGenre')
            ->with($this->equalTo($userId))
            ->willReturn($expectedGenres);

        $result = $this->bookModel->getBooksByGenre($userId);
        
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertEquals('Tecnologia', $result[0]['genre']);
        $this->assertEquals(5, $result[0]['count']);
    }

    // Teste: Verificar se é possível obter livros recentes
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_get_recent_books() {
        $userId = 1;
        $limit = 5;
        $expectedBooks = [
            ['id' => 5, 'title' => 'Livro 5'],
            ['id' => 4, 'title' => 'Livro 4'],
            ['id' => 3, 'title' => 'Livro 3'],
            ['id' => 2, 'title' => 'Livro 2'],
            ['id' => 1, 'title' => 'Livro 1']
        ];

        $this->bookModel->expects($this->once())
            ->method('getRecentBooks')
            ->with($this->equalTo($userId), $this->equalTo($limit))
            ->willReturn($expectedBooks);

        $result = $this->bookModel->getRecentBooks($userId, $limit);
        
        $this->assertIsArray($result);
        $this->assertCount(5, $result);
    }

    // Teste: Verificar se campos obrigatórios são validados
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_require_mandatory_fields() {
        $bookData = [
            'title' => '',
            'author' => '',
            'genre' => '',
            'id_user' => 1
        ];

        // Simula que a criação falha por falta de campos obrigatórios
        $this->bookModel->expects($this->once())
            ->method('createBook')
            ->with($this->equalTo($bookData))
            ->willReturn(false);

        $result = $this->bookModel->createBook($bookData);
        
        $this->assertFalse($result);
    }
}
?>
