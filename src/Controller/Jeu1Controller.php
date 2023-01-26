<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Jeu1Controller extends AbstractController
{
    #[Route('/jeu1', name: 'app_jeu1')]
    public function index(): Response
    {
        return $this->render('jeu1/index.html.twig', [
            'controller_name' => 'Jeu1Controller',
        ]);
    }
}
