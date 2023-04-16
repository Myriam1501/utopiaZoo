<?php

namespace App\Controller;


use App\Repository\ProgramRepository;
use App\Repository\ReservationRepository;
use App\Repository\TicketRepository;
use App\Service\PdfService;
use App\Service\ReservationService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationPDFController extends AbstractController
{
    #[Route('/reservation/{amount}/{name}/{prenom}/{date}', name: 'app_reservation_p_d_f')]
    public function index(string $amount,string $name,string $prenom,string $date): Response
    {
        return $this->render('reservation_pdf/index.html.twig', [
            'nom' => $name,
            'prenom' => $prenom,
            'date' => $date,
            'amount' => $amount
        ]);
    }

    #[Route('/payment/pdf/{name}/{prenom}/{id}', name: 'app_reservation_pdf')]
    public function generatePdf($id,ReservationRepository $reservationRepository,
                                TicketRepository $ticketRepository,
                                ProgramRepository $programRepository,Request $request,string $name,
                                string $prenom,PdfService $pdf): Response
    {
        $reservService=new ReservationService($request->getSession());
        $reser=$reservService->generateReservation($reservationRepository,$id);
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
