<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DecouverteController extends AbstractController
{
    #[Route('/decouverte', name: 'app_decouverte')]
    public function index(): Response
    {
        return $this->render('decouverte/index.html.twig', [
            'controller_name' => 'DecouverteController',
        ]);
    }
}
