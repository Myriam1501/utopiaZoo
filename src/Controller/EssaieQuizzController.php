<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EssaieQuizzController extends AbstractController
{
    #[Route('/essaie/quizz', name: 'app_essaie_quizz')]
    public function index(): Response
    {
        return $this->render('essaie_quizz/index.html.twig', [
            'controller_name' => 'EssaieQuizzController',
        ]);
    }
}
