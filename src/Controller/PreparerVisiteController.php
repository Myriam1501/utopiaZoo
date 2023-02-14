<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PreparerVisiteController extends AbstractController
{
    #[Route('/preparerVisite', name: 'app_preparerVisite')]
    public function index(): Response
    {
        return $this->render('preparerVisite/index.html.twig', [
            'controller_name' => 'PreparerVisiteController',
        ]);
    }
}
