<?php

namespace App\Factory;

use App\Entity\ApiToken;
use App\Repository\ApiTokenRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ApiToken>
 *
 * @method        ApiToken|Proxy<ApiToken>                     create(array<string, mixed>|callable $attributes = [])
 * @method static ApiToken|Proxy<ApiToken>                     createOne(array<string, mixed> $attributes = [])
 * @method static ApiToken|Proxy<ApiToken>                     find(object|array<string, mixed>|mixed $criteria)
 * @method static ApiToken|Proxy<ApiToken>                     findOrCreate(array<string, mixed> $attributes)
 * @method static ApiToken|Proxy<ApiToken>                     first(string $sortedField = 'id')
 * @method static ApiToken|Proxy<ApiToken>                     last(string $sortedField = 'id')
 * @method static ApiToken|Proxy<ApiToken>                     random(array<string, mixed> $attributes = [])
 * @method static ApiToken|Proxy<ApiToken>                     randomOrCreate(array<string, mixed> $attributes = [])
 * @method static ApiTokenRepository|RepositoryProxy<ApiToken> repository()
 * @method static ApiToken[]|Proxy<ApiToken>[]                 all()
 * @method static ApiToken[]|Proxy<ApiToken>[]                 createMany(int $number, array<string, mixed>|callable $attributes = [])
 * @method static ApiToken[]|Proxy<ApiToken>[]                 createSequence(iterable<int, array<string, mixed>>|callable $sequence)
 * @method static ApiToken[]|Proxy<ApiToken>[]                 findBy(array<string, mixed> $attributes)
 * @method static ApiToken[]|Proxy<ApiToken>[]                 randomRange(int $min, int $max, array<string, mixed> $attributes = [])
 * @method static ApiToken[]|Proxy<ApiToken>[]                 randomSet(int $number, array<string, mixed> $attributes = [])
 */
final class ApiTokenFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     */
    protected function getDefaults(): array
    {
        return [
            'ownedBy' => UserFactory::random(),
            'scopes' => [
                ApiToken::SCOPE_TASK_CREATE,
                ApiToken::SCOPE_USER_EDIT,
            ],
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ApiToken $apiToken): void {})
            ;
    }

    protected static function getClass(): string
    {
        return ApiToken::class;
    }
}
