<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Ticket;
use App\Repository\ProgramRepository;
use App\Repository\TicketRepository;
use App\Service\PaymentService;
use App\Service\PdfService;
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
            'controller_name' => 'PaymentController',
            'amount' => $prix,
            'intent' => $intent
        ]);
    }

    #[Route('/payment/pdf/{name}/{prenom}', name: 'app_payment_pdf')]
    public function generatePdf(TicketRepository $ticketRepository,EntityManagerInterface $entityManager,ProgramRepository $programRepository,Request $request,string $name,string $prenom,PdfService $pdf): Response
    {
        $session = $request->getSession();
        $amount=$session->get("priceTotal");
        $date=new \DateTime('now');
        $stringDate=$date->format('Y-m-d H:i:s');
        $reser=new Reservation();
        $reser->setDate($date);
        $reser->setUser($this->getUser());
        $reser->setPrice($session->get("priceTotal"));
        $entityManager->persist($reser);
        $entityManager->flush();
        $programmes=$programRepository->findAll();

        foreach ($programmes as $p){
            if($session->has($p->getTitle())){
                $t=new Ticket();
                $t->setProgram($p);
                $t->setQteNormal($session->get($p->getTitle()));
                $t->setReservation($reser);
                $entityManager->persist($t);
                $entityManager->flush();
            }
        }


        $ticketsOfReservation=$ticketRepository->findBy(array('reservation'=>$reser));
        $session->clear();

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