<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Jeu6Controller extends AbstractController
{
    #[Route('/jeu6', name: 'app_jeu6')]
    public function index(): Response
    {
        return $this->render('jeu6/index.html.twig', [
            'controller_name' => 'Jeu6Controller',
        ]);
    }
}
