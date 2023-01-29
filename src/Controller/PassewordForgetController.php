<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PassewordForgetController extends AbstractController
{
    #[Route('/passeword/forget', name: 'app_passeword_forget')]
    public function index(): Response
    {
        return $this->render('passeword_forget/index.html.twig', [
            'controller_name' => 'PassewordForgetController',
        ]);
    }
}
