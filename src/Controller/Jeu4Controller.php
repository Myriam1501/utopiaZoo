<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Jeu4Controller extends AbstractController
{
    #[Route('/jeu4', name: 'app_jeu4')]
    public function index(): Response
    {
        return $this->render('jeu4/index.html.twig', [
            'controller_name' => 'Jeu4Controller',
        ]);
    }
}
