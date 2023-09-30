<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class HomeController extends AbstractController
{
    public function __construct(
        private EventRepository $eventRepository,
    ){}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $colors = ["#FBF7EE", "#EC5D39", "#0282F1", "#FF72CE"];

        $nextEvents = $this->eventRepository->nextEvents();

        return $this->render('pro/index.html.twig', [
            'nextEvents' => $nextEvents,
        ]);
    }

    #[Route('/landing-page', name: 'app_landing_page')]
    public function landingPage(): Response
    {
        return $this->render('landing_page/landing_page.html.twig', [
            
        ]);
    }
}
