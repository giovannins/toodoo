<?php

namespace App\Controller;

use App\Repository\UserlistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodolistController extends AbstractController
{
    #[Route('/todolist', name: 'todolist_index', methods: ['GET'])]
    public function index(RequestStack $requestStack, UserlistRepository $userlistRepository): Response
    {
        $session = $requestStack->getSession();
        $todo = $userlistRepository->findBy(['access_id' => $session->get('id')]);
        if ($session->get('login')) {
            return $this->render('todolist/index.html.twig', [
                'app_name' => $_ENV['APP_NAME'],
                'todo' => $todo,
                'id' => $session->get('id')
            ]);
        }

        return new RedirectResponse('/');
    }

    #[Route('/delete/{id}', name: 'todolist_delete', methods: ['DELETE'])]
    public function delete(RequestStack $requestStack, int $id) {

    }
}
