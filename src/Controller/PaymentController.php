<?php

namespace App\Controller;

use App\Service\PaymentService;
use App\Service\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment/{amount}', name: 'app_payment', methods: ['GET', 'POST'])]
    public function index(string $amount,PaymentService $pay): Response
    {

        $prix=(float)$amount;
        $intent=$pay->setAPI($prix);

        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
            'amount' => $amount,
            'intent' => $intent
        ]);
    }

    #[Route('/payment/pdf/{amount}/{name}/{prenom}/{date}', name: 'app_payment_pdf')]
    public function generatePdf(string $amount,string $name,string $prenom,string $date,PdfService $pdf): Response
    {

        $html = $this->render('reservation_pdf/index.html.twig', [
            'controller_name' => 'ReservationPDFController',
            'nom' => $name,
            'prenom' => $prenom,
            'date' => $date,
            'amount' => $amount
        ]);
        $pdf->showPdfFile($html);

        return $this->render('reservation_pdf/index.html.twig', [
            'controller_name' => 'ReservationPDFController',
            'nom' => $name,
            'prenom' => $prenom,
            'date' => $date,
            'amount' => $amount
        ]);
    }
}
