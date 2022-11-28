<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodolistController extends AbstractController
{
    #[Route('/todolist', name: 'todolist_index', methods: ['GET'])]
    public function index(RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();

        if ($session->get('login')) {
            return $this->render('todolist/index.html.twig', [
                'app_name' => $_ENV['APP_NAME'],
            ]);
        }

        return new RedirectResponse('/');
    }
}
