<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationPDFController extends AbstractController
{
    #[Route('/reservation/{amount}/{name}/{prenom}/{date}', name: 'app_reservation_p_d_f')]
    public function index(string $amount,string $name,string $prenom,string $date): Response
    {
        return $this->render('reservation_pdf/index.html.twig', [
            'controller_name' => 'ReservationPDFController',
            'nom' => $name,
            'prenom' => $prenom,
            'date' => $date,
            'amount' => $amount
        ]);
    }
}
