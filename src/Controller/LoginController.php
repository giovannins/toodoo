<?php

namespace App\Controller;

use App\Entity\Access;
use App\Repository\AccessRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
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
    public function login(Request $request, RequestStack $requestStack, ManagerRegistry $doc, AccessRepository $access): Response
    {
        $session = $requestStack->getSession();
        $password = $request->get('password');
        $db_pass = $access->findOneBy(['password' => $password]);

        if (strlen($request->get('password')) < 8) {

            return new RedirectResponse('/?error=small_password');
        }

        if ($db_pass) {
            $session->set('login', true);
            $session->set('id', $db_pass->getId());

            return new RedirectResponse('/todolist');
        }

        $manager = $doc->getManager();

        $new_access = new Access();
        $new_access->setPassword($password);
        
        $manager->persist($new_access);
        $manager->flush();

        $session->set('login', true);
        $session->set('id', $new_access->getId());

        return new RedirectResponse('/todolist');
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $session->remove('login');
        $session->remove('id');

        return new RedirectResponse('/');
    }
}
