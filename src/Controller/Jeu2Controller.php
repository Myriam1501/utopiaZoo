<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Jeu2Controller extends AbstractController
{
    #[Route('/jeu2', name: 'app_jeu2')]
    public function index(): Response
    {
        return $this->render('jeu2/index.html.twig', [
            'controller_name' => 'Jeu2Controller',
        ]);
    }
}
