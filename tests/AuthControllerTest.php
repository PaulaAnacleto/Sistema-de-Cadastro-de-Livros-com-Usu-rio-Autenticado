<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../Controller/AuthController.php';

class AuthControllerTest extends TestCase {
    private $auth;

    protected function setUp(): void {
        $this->auth = new AuthController();
    }

    public function testLogout() {
        $result = $this->auth->logout();
        $this->assertTrue($result);
    }
}
