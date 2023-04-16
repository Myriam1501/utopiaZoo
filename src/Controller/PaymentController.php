<?php

namespace App\Controller;


use App\Repository\ProgramRepository;
use App\Repository\TicketRepository;
use App\Service\PaymentService;
use App\Service\PdfService;
use App\Service\ReservationService;

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
    public function generatePdf(TicketRepository $ticketRepository,EntityManagerInterface $entityManager,
                                ProgramRepository $programRepository,Request $request,string $name,
                                string $prenom,PdfService $pdf): Response
    {
        $reservService=new ReservationService($request->getSession());
        $reser=$reservService->addReservation($this->getUser(),$programRepository,$entityManager);
        $html = $this->render('fragments/reservation.html.twig', [
            'nom' => $name,
            'prenom' => $prenom,
            'date' => (new DateTime('now'))->format('Y-m-d H:i:s'),
            'amount' => $reser->getPrice(),
            'tickets' => $ticketRepository->findBy(array('reservation'=>$reser)),
            'programmes' => $programRepository->findAll(),
            'reservation' => $reser,
        ]);
        $pdf->showPdfFile($html);
        return $html;
    }
}