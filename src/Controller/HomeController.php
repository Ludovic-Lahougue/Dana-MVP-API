<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('pro/index.html.twig', [
        ]);
    }

    #[Route('/landing-page', name: 'app_landing_page')]
    public function landingPage(): Response
    {
        return $this->render('landing_page/landing_page.html.twig', [
            
        ]);
    }
}
