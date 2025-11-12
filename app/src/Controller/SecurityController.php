<?php

namespace App\Controller;

use App\Entity\User;
use App\Exception\NotReachedException;
use App\Repository\ApiTokenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: "app_login", methods: Request::METHOD_POST)]
    public function login(ApiTokenRepository $apiTokenRepository, #[CurrentUser] ?User $user = null): JsonResponse
    {
        if (null === $user) {
            return $this->json([
                'error' => 'Invalid credentials or failed authentication.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'user' => $user->getUserIdentifier(),
            'tokens' => $user->getApiTokens()
        ], Response::HTTP_OK);
    }


    #[Route(path: '/logout', name: "app_logout")]
    public function logout(): void
    {
        throw new NotReachedException();
    }
}