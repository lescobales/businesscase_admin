<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(Security $security): Response
    {
        //if(!$this->getUser()){
        if (!$security->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_login');
        } else
            return $this->render('home/index.html.twig');
    }
}