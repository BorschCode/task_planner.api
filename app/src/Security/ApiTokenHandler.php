<?php

namespace App\Security;

use App\Repository\ApiTokenRepository;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\AccessToken\AccessTokenHandlerInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

class ApiTokenHandler implements AccessTokenHandlerInterface
{
    public function __construct(
        private readonly ApiTokenRepository $apiTokens
    ) {
    }

    // Removed the #[NoReturn] attribute and its use statement (Line 17, attribute not found)
    public function getUserBadgeFrom(#[\SensitiveParameter] string $accessToken): UserBadge
    {
        $apiToken = $this->apiTokens->findOneBy(['token' => $accessToken]);

        if (null === $apiToken || !$apiToken->isValid()) {
            throw new BadCredentialsException('Invalid credentials.');
        }

        return new UserBadge($apiToken->getOwnedBy()->getUserIdentifier());
    }
}
