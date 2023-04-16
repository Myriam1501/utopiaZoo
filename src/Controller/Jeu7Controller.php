<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Jeu7Controller extends AbstractController
{
    #[Route('/jeu7', name: 'app_jeu7')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        return $this->render('jeu7/index.html.twig', [
            'session' => $session,
        ]);
    }
}
