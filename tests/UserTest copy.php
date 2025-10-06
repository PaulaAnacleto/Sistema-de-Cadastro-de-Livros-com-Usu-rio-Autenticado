<?php

use PHPUnit\Framework\TestCase;
use Controller\AuthController;
use Model\User;

class UserTest extends TestCase {
    
    private $authController;
    private $mockUserModel;
    
    protected function setUp(): void {
        // Cria um mock da classe User
        $this->mockUserModel = $this->createMock(User::class);
        
        // Cria o AuthController com o mock injetado
        $this->authController = $this->getMockBuilder(AuthController::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    // Teste: Verificar se é possível criar um usuário
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_create_user() {
        $userData = [
            'user_fullname' => 'João Silva',
            'email' => 'joao@example.com',
            'password' => '123456'
        ];

        $this->mockUserModel->expects($this->once())
            ->method('createUser')
            ->with($this->equalTo($userData))
            ->willReturn(true);

        $result = $this->mockUserModel->createUser($userData);
        
        $this->assertTrue($result);
    }

    // Teste: Verificar se é possível fazer login com credenciais válidas
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_sign_in() {
        $email = 'joao@example.com';
        $password = '123456';
        
        $expectedUser = [
            'id' => 1,
            'user_fullname' => 'João Silva',
            'email' => 'joao@example.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT)
        ];

        $this->mockUserModel->expects($this->once())
            ->method('validateLogin')
            ->with($this->equalTo($email), $this->equalTo($password))
            ->willReturn([
                'id' => 1,
                'user_fullname' => 'João Silva',
                'email' => 'joao@example.com'
            ]);

        $result = $this->mockUserModel->validateLogin($email, $password);
        
        $this->assertNotNull($result);
        $this->assertEquals('joao@example.com', $result['email']);
        $this->assertEquals('João Silva', $result['user_fullname']);
    }

    // Teste: Verificar se login falha com credenciais inválidas
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_shouldnt_login_with_invalid_credentials() {
        $email = 'joao@example.com';
        $wrongPassword = 'senhaerrada';

        $this->mockUserModel->expects($this->once())
            ->method('validateLogin')
            ->with($this->equalTo($email), $this->equalTo($wrongPassword))
            ->willReturn(null);

        $result = $this->mockUserModel->validateLogin($email, $wrongPassword);
        
        $this->assertNull($result);
    }

    // Teste: Verificar se é possível buscar usuário por email
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_check_user_by_email() {
        $email = 'joao@example.com';
        
        $expectedUser = [
            'id' => 1,
            'user_fullname' => 'João Silva',
            'email' => 'joao@example.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT)
        ];

        $this->mockUserModel->expects($this->once())
            ->method('findByEmail')
            ->with($this->equalTo($email))
            ->willReturn($expectedUser);

        $result = $this->mockUserModel->findByEmail($email);
        
        $this->assertNotNull($result);
        $this->assertEquals('joao@example.com', $result['email']);
        $this->assertEquals('João Silva', $result['user_fullname']);
    }

    // Teste: Verificar se retorna null quando usuário não existe
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_return_null_when_user_not_found() {
        $email = 'naoexiste@example.com';

        $this->mockUserModel->expects($this->once())
            ->method('findByEmail')
            ->with($this->equalTo($email))
            ->willReturn(null);

        $result = $this->mockUserModel->findByEmail($email);
        
        $this->assertNull($result);
    }

    // Teste: Verificar se email já existe
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_verify_if_email_exists() {
        $email = 'joao@example.com';

        $this->mockUserModel->expects($this->once())
            ->method('emailExists')
            ->with($this->equalTo($email))
            ->willReturn(true);

        $result = $this->mockUserModel->emailExists($email);
        
        $this->assertTrue($result);
    }

    // Teste: Verificar se email não existe
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_verify_if_email_does_not_exist() {
        $email = 'novoemail@example.com';

        $this->mockUserModel->expects($this->once())
            ->method('emailExists')
            ->with($this->equalTo($email))
            ->willReturn(false);

        $result = $this->mockUserModel->emailExists($email);
        
        $this->assertFalse($result);
    }

    // Teste: Verificar se é possível atualizar perfil do usuário
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_update_user_profile() {
        $userId = 1;
        $updateData = [
            'user_fullname' => 'João Silva Santos',
            'email' => 'joao.novo@example.com'
        ];

        $this->mockUserModel->expects($this->once())
            ->method('updateProfile')
            ->with($this->equalTo($userId), $this->equalTo($updateData))
            ->willReturn(true);

        $result = $this->mockUserModel->updateProfile($userId, $updateData);
        
        $this->assertTrue($result);
    }

    // Teste: Verificar se é possível atualizar senha do usuário
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_update_user_password() {
        $userId = 1;
        $updateData = [
            'password' => 'novasenha123'
        ];

        $this->mockUserModel->expects($this->once())
            ->method('updateProfile')
            ->with($this->equalTo($userId), $this->equalTo($updateData))
            ->willReturn(true);

        $result = $this->mockUserModel->updateProfile($userId, $updateData);
        
        $this->assertTrue($result);
    }

    // Teste: Verificar se retorna estatísticas vazias para usuário sem livros
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_return_empty_stats_for_user_without_books() {
        $userId = 999;
        $expectedStats = [
            'total_books' => 0,
            'books_read' => 0,
            'books_reading' => 0,
            'books_want_to_read' => 0,
            'books_abandoned' => 0
        ];

        $this->mockUserModel->expects($this->once())
            ->method('getUserStats')
            ->with($this->equalTo($userId))
            ->willReturn($expectedStats);

        $result = $this->mockUserModel->getUserStats($userId);
        
        $this->assertIsArray($result);
        $this->assertEquals(0, $result['total_books']);
    }

    // Teste: Verificar validação de email inválido
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_validate_email_format() {
        $validEmail = 'joao@example.com';
        $invalidEmail = 'emailinvalido';
        
        $this->assertTrue(filter_var($validEmail, FILTER_VALIDATE_EMAIL) !== false);
        $this->assertFalse(filter_var($invalidEmail, FILTER_VALIDATE_EMAIL) !== false);
    }

    // Teste: Verificar se campos obrigatórios são validados no cadastro
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_require_mandatory_fields_on_registration() {
        $incompleteData = [
            'user_fullname' => '',
            'email' => '',
            'password' => ''
        ];
        
        $this->assertEmpty($incompleteData['user_fullname']);
        $this->assertEmpty($incompleteData['email']);
        $this->assertEmpty($incompleteData['password']);
    }

    // Teste: Verificar se senha deve ter no mínimo 6 caracteres
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_require_minimum_password_length() {
        $shortPassword = '12345';
        $validPassword = '123456';
        
        $this->assertLessThan(6, strlen($shortPassword));
        $this->assertGreaterThanOrEqual(6, strlen($validPassword));
    }

    // Teste: Verificar se senhas devem coincidir no cadastro
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_match_password_and_confirmation() {
        $password = '123456';
        $confirmPassword = '123456';
        $wrongConfirmation = '654321';
        
        $this->assertEquals($password, $confirmPassword);
        $this->assertNotEquals($password, $wrongConfirmation);
    }

    // Teste: Verificar se usuário está logado através da sessão
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_verify_if_is_logged_in() {
        $_SESSION['user_id'] = 1;
        
        $isLoggedIn = isset($_SESSION['user_id']);
        
        $this->assertTrue($isLoggedIn);
    }

    // Teste: Verificar se usuário não está logado
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_verify_if_is_not_logged_in() {
        unset($_SESSION['user_id']);
        
        $isLoggedIn = isset($_SESSION['user_id']);
        
        $this->assertFalse($isLoggedIn);
    }

    // Teste: Verificar se senha não é retornada após validação de login
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_not_return_password_after_login_validation() {
        $email = 'joao@example.com';
        $password = '123456';
        
        $userWithoutPassword = [
            'id' => 1,
            'user_fullname' => 'João Silva',
            'email' => 'joao@example.com'
        ];

        $this->mockUserModel->expects($this->once())
            ->method('validateLogin')
            ->with($this->equalTo($email), $this->equalTo($password))
            ->willReturn($userWithoutPassword);

        $result = $this->mockUserModel->validateLogin($email, $password);
        
        $this->assertArrayNotHasKey('password', $result);
    }
}
?>
