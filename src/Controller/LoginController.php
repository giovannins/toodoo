<?php

namespace App\Controller;

use App\Entity\Access;
use App\Repository\AccessRepository;
use Doctrine\Persistence\ManagerRegistry;
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
    public function login(Request $req, ManagerRegistry $doc, AccessRepository $access): Response
    {
        $password = $req->get('password');
        $db_pass = $access->findOneBy(['password' => $password]);

        if (strlen($req->get('password')) < 8) {
            return new RedirectResponse('/?error=small_password');
        }

        if ($db_pass) {
            return new Response($req->get('password'));
        }

        $manager = $doc->getManager();

        $new_access = new Access();
        $new_access->setPassword($password);
        
        $manager->persist($new_access);
        $manager->flush();

        return new Response($new_access->getId());

    }

    #[Route('/logout', name: 'app_logout', methods: ['GET', 'POST'])]
    public function logout(): Response
    {
        return new Response('logout');
    }
}


