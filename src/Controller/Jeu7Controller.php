<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Jeu7Controller extends AbstractController
{
    #[Route('/jeu7', name: 'app_jeu7')]
    public function index(): Response
    {
        return $this->render('jeu7/index.html.twig', [
            'controller_name' => 'Jeu7Controller',
        ]);
    }
}
