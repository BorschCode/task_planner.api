<?php

declare(strict_types=1);

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    // Fix 1: Added 'string' type hint to $class
    public function supportsClass(string $class): bool
    {
        return $class === \App\Entity\User::class;
    }


    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findByAccessToken($identifier);
        if (!$user) {
            throw new UserNotFoundException(sprintf('User with custom field "%s" not found.', $identifier));
        }
        return $user;
    }

    // Fix 2: Added 'UserInterface' return type and implemented logic
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof \App\Entity\User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        // This provider is designed to load a user via an access token, suggesting a stateless
        // token-based API. For these types of APIs, refreshing the user's state is generally
        // not supported, so throwing this exception is the correct implementation.
        throw new UnsupportedUserException('Refreshing user is not supported for this provider.');
    }
}
