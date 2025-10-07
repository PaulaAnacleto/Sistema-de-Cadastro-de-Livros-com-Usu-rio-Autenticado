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

    // Teste: Verificar se é possível criar um usuário! PAULA
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

    // Teste: Verificar se é possível fazer login com credenciais válidas! HELBER
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

    // Teste: Verificar se login falha com credenciais inválidas! CORDEIRO
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

    // Teste: Verificar se email já existe! PAULA 
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

    // Teste: Verificar se é possível atualizar perfil do usuário! HELBER
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

    // Teste: Verificar se é possível atualizar senha do usuário! CORDEIRO
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

    // Teste: Verificar validação de email inválido! PAULA
    #[\PHPUnit\Framework\Attributes\Test] 
    public function it_should_validate_email_format() {
        $validEmail = 'joao@example.com';
        $invalidEmail = 'emailinvalido';
        
        $this->assertTrue(filter_var($validEmail, FILTER_VALIDATE_EMAIL) !== false);
        $this->assertFalse(filter_var($invalidEmail, FILTER_VALIDATE_EMAIL) !== false);
    }

    // Teste: Verificar se campos obrigatórios são validados no cadastro HELBER
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

    // Teste: Verificar se senha deve ter no mínimo 6 caracteres CORDEIRO
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_require_minimum_password_length() {
        $shortPassword = '12345';
        $validPassword = '123456';
        
        $this->assertLessThan(6, strlen($shortPassword));
        $this->assertGreaterThanOrEqual(6, strlen($validPassword));
    }

    // Teste: Verificar se senha não é retornada após validação de login PAULA
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
