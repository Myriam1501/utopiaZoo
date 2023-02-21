<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Cookies extends AbstractController
{
    #[Route('Location:./', name: 'app_decouverte')]
    public function cookies() {

        return $this->render('Location:./', [
            'controller_name' => 'DecouverteController',
        ]);
    }

}