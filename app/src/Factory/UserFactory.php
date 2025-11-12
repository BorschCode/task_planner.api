<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<User>
 *
 * @method        User|Proxy<User>                     create(array<string, mixed>|callable $attributes = [])
 * @method static User|Proxy<User>                     createOne(array<string, mixed> $attributes = [])
 * @method static User|Proxy<User>                     find(object|array|mixed $criteria)
 * @method static User|Proxy<User>                     findOrCreate(array<string, mixed> $attributes)
 * @method static User|Proxy<User>                     first(string $sortedField = 'id')
 * @method static User|Proxy<User>                     last(string $sortedField = 'id')
 * @method static User|Proxy<User>                     random(array<string, mixed> $attributes = [])
 * @method static User|Proxy<User>                     randomOrCreate(array<string, mixed> $attributes = [])
 * @method static UserRepository|RepositoryProxy<User> repository()
 * // phpcs:disable
 * @method static User[]|Proxy<User>[]                 all()
 * @method static User[]|Proxy<User>[]                 createMany(int $number, array<string, mixed>|callable $attributes = [])
 * @method static User[]|Proxy<User>[]                 createSequence(iterable<array<string, mixed>|callable(): array<string, mixed>> $sequence)
 * @method static User[]|Proxy<User>[]                 findBy(array<string, mixed> $attributes)
 * @method static User[]|Proxy<User>[]                 randomRange(int $min, int $max, array<string, mixed> $attributes = [])
 * @method static User[]|Proxy<User>[]                 randomSet(int $number, array<string, mixed> $attributes = [])
 * // phpcs:enable
 */
final class UserFactory extends ModelFactory
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
            'email' => self::faker()->text(180),
            'password' => self::faker()->text(),
            'roles' => [],
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(User $user): void {})
            ;
    }

    protected static function getClass(): string
    {
        return User::class;
    }
}
