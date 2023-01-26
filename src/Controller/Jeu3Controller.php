<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Jeu3Controller extends AbstractController
{
    #[Route('/jeu3', name: 'app_jeu3')]
    public function index(): Response
    {
        return $this->render('jeu3/index.html.twig', [
            'controller_name' => 'Jeu3Controller',
        ]);
    }
}
