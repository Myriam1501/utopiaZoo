<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Jeu5Controller extends AbstractController
{
    #[Route('/jeu5', name: 'app_jeu5')]
    public function index(): Response
    {
        return $this->render('jeu5/index.html.twig', [
            'controller_name' => 'Jeu5Controller',
        ]);
    }
}
