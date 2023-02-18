<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationPDFController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation_p_d_f')]
    public function index(): Response
    {
        return $this->render('reservation_pdf/index.html.twig', [
            'controller_name' => 'ReservationPDFController',
        ]);
    }
}
