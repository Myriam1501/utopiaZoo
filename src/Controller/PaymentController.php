<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Ticket;
use App\Repository\ProgramRepository;
use App\Service\PaymentService;
use App\Service\PdfService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment/{amount}', name: 'app_payment', methods: ['GET', 'POST'])]
    public function index($amount,PaymentService $pay): Response
    {
        $prix=(float)$amount;
        $intent=$pay->setAPI($prix);
        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
            'amount' => $amount,
            'intent' => $intent
        ]);
    }

    #[Route('/payment/pdf/{amount}/{name}/{prenom}', name: 'app_payment_pdf')]
    public function generatePdf(EntityManagerInterface $entityManager,ProgramRepository $programRepository,Request $request,string $amount,string $name,string $prenom,PdfService $pdf): Response
    {
        $date=new \DateTime('now');
        $stringDate=$date->format('Y-m-d H:i:s');
        $reser=new Reservation();
        $reser->setDate($date);
        $entityManager->persist($reser);
        $entityManager->flush();
        $programmes=$programRepository->findAll();
        $session = $request->getSession();
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


        $html = $this->render('fragments/reservation.html.twig', [
            'controller_name' => 'ReservationPDFController',
            'nom' => $name,
            'prenom' => $prenom,
            'date' => $stringDate,
            'amount' => $amount
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
