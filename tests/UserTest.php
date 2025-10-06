<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../Model/User.php';

class UserTest extends TestCase {
    private $user;

    protected function setUp(): void {
        $this->user = new User();
    }

    public function testRegisterUser() {
        $result = $this->user->register("Paula", "paula@email.com", "123456");
        $this->assertTrue($result);
    }

    public function testLoginValidUser() {
        $result = $this->user->login("paula@email.com", "123456");
        $this->assertTrue($result);
    }
}
