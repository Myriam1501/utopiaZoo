<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProtectWildlifeController extends AbstractController
{
    #[Route('/protect/wildlife', name: 'app_protect_wildlife', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('protect_wildlife/index.html.twig');
    }
}
