<?php

namespace App\Controller;

use App\Service\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment/{amount}', name: 'app_payment', methods: ['GET', 'POST'])]
    public function index(string $amount): Response
    {

        $prix=(float)$amount;
        \Stripe\Stripe::setApiKey('sk_test_51Mco2mCmQpXm4b5Y804cXBizL6i9TvJmyyAavOdwOuIgul9diNg0GzFQh4eTCKVv0s3uNNpVd3wVi1XXDyL4psOj00n8pXh4JI');
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $prix*100,
            'currency' => 'eur'
        ]);

        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
            'amount' => $amount,
            'intent' => $intent
        ]);
    }

    #[Route('/payment/pdf/pdf', name: 'app_payment_pdf')]
    public function generatePdf(PdfService $pdf): Response
    {

        $html = $this->render('reservation_pdf/index.html.twig', [
            'controller_name' => 'ReservationPDFController',
        ]);
        $pdf->showPdfFile($html);

        return $this->render('reservation_pdf/index.html.twig', [
            'controller_name' => 'ReservationPDFController',
        ]);
    }
}
