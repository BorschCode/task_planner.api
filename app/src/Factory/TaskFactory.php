<?php

namespace App\Factory;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Task>
 *
 * @method        Task|Proxy<Task>                     create(array<string, mixed>|callable $attributes = [])
 * @method static Task|Proxy<Task>                     createOne(array<string, mixed> $attributes = [])
 * @method static Task|Proxy<Task>                     find(object|array|mixed $criteria)
 * @method static Task|Proxy<Task>                     findOrCreate(array<string, mixed> $attributes)
 * @method static Task|Proxy<Task>                     first(string $sortedField = 'id')
 * @method static Task|Proxy<Task>                     last(string $sortedField = 'id')
 * @method static Task|Proxy<Task>                     random(array<string, mixed> $attributes = [])
 * @method static Task|Proxy<Task>                     randomOrCreate(array<string, mixed> $attributes = [])
 * @method static TaskRepository|RepositoryProxy<Task> repository()
 * @method static Task[]|Proxy<Task>[]                 all()
 * @method static Task[]|Proxy<Task>[]                 createMany(int $number, array<string, mixed>|callable $attributes = [])
 * @method static Task[]|Proxy<Task>[]                 createSequence(iterable<array<string, mixed>|callable>|callable $sequence)
 * @method static Task[]|Proxy<Task>[]                 findBy(array<string, mixed> $attributes)
 * @method static Task[]|Proxy<Task>[]                 randomRange(int $min, int $max, array<string, mixed> $attributes = [])
 * @method static Task[]|Proxy<Task>[]                 randomSet(int $number, array<string, mixed> $attributes = [])
 */
final class TaskFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'owner' => UserFactory::new(),
            'priority' => self::faker()->randomNumber(),
            'status' => self::faker()->text(100),
            'title' => self::faker()->text(255),
//            'parent' => TaskFactory::random(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Task $task): void {})
            ;
    }

    protected static function getClass(): string
    {
        return Task::class;
    }
}
