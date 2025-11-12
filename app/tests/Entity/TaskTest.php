<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testTaskCreation(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');

        $task = new Task();
        $task->setTitle('Test Task');
        $task->setDescription('Test Description');
        $task->setStatus('todo');
        $task->setPriority(1);
        $task->setOwner($user);
        $task->setCreatedAt(new \DateTimeImmutable());

        $this->assertEquals('Test Task', $task->getTitle());
        $this->assertEquals('Test Description', $task->getDescription());
        $this->assertEquals('todo', $task->getStatus());
        $this->assertEquals(1, $task->getPriority());
        $this->assertEquals($user, $task->getOwner());
        $this->assertInstanceOf(\DateTimeImmutable::class, $task->getCreatedAt());
    }

    public function testTaskParentChild(): void
    {
        $parentTask = new Task();
        $parentTask->setTitle('Parent Task');

        $childTask = new Task();
        $childTask->setTitle('Child Task');

        $parentTask->addChild($childTask);

        $this->assertTrue($parentTask->getChildren()->contains($childTask));
        $this->assertEquals($parentTask, $childTask->getParent());
    }
}