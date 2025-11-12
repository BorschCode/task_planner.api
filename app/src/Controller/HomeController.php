<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * Renders the client-side form for API authentication.
     */
    #[Route('/login-api', name: 'api_login_form')]
    public function loginForm(): Response
    {
        // This renders the new Twig template containing the login client
        return $this->render('home/login.html.twig');
    }
}
