<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCreation(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setPassword('password123');

        $this->assertEquals('test@example.com', $user->getEmail());
        $this->assertEquals('test@example.com', $user->getUserIdentifier());
        $this->assertEquals('password123', $user->getPassword());
        $this->assertContains('ROLE_USER', $user->getRoles());
    }

    public function testUserRoles(): void
    {
        $user = new User();
        $user->setRoles(['ROLE_ADMIN']);

        $roles = $user->getRoles();
        $this->assertContains('ROLE_USER', $roles);
        $this->assertContains('ROLE_ADMIN', $roles);
    }
}