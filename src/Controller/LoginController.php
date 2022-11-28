<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(Request $req): Response
    {
        $login_valido = false;

        if ($req->query->get('error') == 'small_password') {
            $login_valido = true;
        }
        
        return $this->render('login/index.html.twig', ['app_name' => $_ENV['APP_NAME'], 'error' => $login_valido]);
    }

    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(Request $req): Response
    {
        if (strlen($req->get('password')) < 8) {
            return new RedirectResponse('/?error=small_password');
        }

        return new Response($req->get('password'));
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET', 'POST'])]
    public function logout(): Response
    {
        return new Response('logout');
    }
}


