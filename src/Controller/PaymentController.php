<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Ticket;
use App\Repository\ProgramRepository;
use App\Repository\TicketRepository;
use App\Service\PaymentService;
use App\Service\PdfService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment', methods: ['GET', 'POST'])]
    public function index(Request $request,PaymentService $pay): Response
    {
        $session = $request->getSession();
        $prix=(float)$session->get("priceTotal");
        $intent=$pay->setAPI($prix);
        return $this->render('payment/index.html.twig', [
            'amount' => $prix,
            'intent' => $intent
        ]);
    }

    #[Route('/payment/pdf/{name}/{prenom}', name: 'app_payment_pdf')]
    public function generatePdf(TicketRepository $ticketRepository,EntityManagerInterface $entityManager,ProgramRepository $programRepository,Request $request,string $name,string $prenom,PdfService $pdf): Response
    {
        return $this->render('reservation_pdf/index.html.twig', [
            'controller_name' => 'ReservationPDFController',
            'nom' => $name,
            'prenom' => $prenom,
            'date' => $stringDate,
            'amount' => $amount
        ]);
    }
}