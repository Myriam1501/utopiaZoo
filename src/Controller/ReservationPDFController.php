<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Ticket;
use App\Repository\ProgramRepository;
use App\Repository\ReservationRepository;
use App\Repository\TicketRepository;
use App\Service\PdfService;
use Doctrine\ORM\EntityManagerInterface;
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
            'controller_name' => 'ReservationPDFController',
            'nom' => $name,
            'prenom' => $prenom,
            'date' => $date,
            'amount' => $amount
        ]);
    }

    #[Route('/payment/pdf/{name}/{prenom}/{id}', name: 'app_reservation_pdf')]
    public function generatePdf($id,ReservationRepository $reservationRepository,TicketRepository $ticketRepository,EntityManagerInterface $entityManager,ProgramRepository $programRepository,Request $request,string $name,string $prenom,PdfService $pdf): Response
    {
        $date=new \DateTime('now');
        $stringDate=$date->format('Y-m-d H:i:s');
        $reser=$reservationRepository->find($id);
        $amount=$reser->getPrice();
        $programmes=$programRepository->findAll();
        $ticketsOfReservation=$ticketRepository->findBy(array('reservation'=>$reser));
        $html = $this->render('fragments/reservation.html.twig', [
            'controller_name' => 'ReservationPDFController',
            'nom' => $name,
            'prenom' => $prenom,
            'date' => $stringDate,
            'amount' => $amount,
            'tickets' => $ticketsOfReservation,
            'programmes' => $programmes,
            'reservation' => $reser,
        ]);
        $pdf->showPdfFile($html);

        return $this->render('reservation_pdf/index.html.twig', [
            'controller_name' => 'ReservationPDFController',
            'nom' => $name,
            'prenom' => $prenom,
            'date' => $stringDate,
            'amount' => $amount
        ]);
    }
}
