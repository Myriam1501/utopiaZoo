<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Reservation;
use App\Entity\Ticket;
use App\Repository\ProgramRepository;
use App\Repository\TicketRepository;
use App\Services\CartServices;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservation = new Reservation();
        $entityManager->persist($reservation);
        $entityManager->flush();

        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation' => $reservation,
        ]);
    }

    #[Route('/reservation/add/{ reservation }/{ program }', name: 'app_reservation', methods: ['GET'])]
    public function add(TicketRepository $ticketRepository, $reservation,Program $program,EntityManagerInterface $entityManager): Response
    {
        $true=0;
        $allTicket=$reservation->getTickets();
        foreach ($allTicket as $t){
            if($t->getProgram==$program->getId()){
                $cart = new CartServices($ticketRepository,$entityManager,$t->getId());
                $cart->addTicket();
                $true=1;
            }
        }

        if($true!=1){
            $ticket=new Ticket();
            $ticket->setProgram($program->getId());
            $ticket->setQteNormal(0);

            $reservation->setTicketsId($ticket->getId());

            $entityManager->persist($ticket);
            $entityManager->flush();

            $entityManager->persist($reservation);
            $entityManager->flush();
        }

        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation' => $reservation,
        ]);
    }

    #[Route('/reservation/del/{ reservation }/{ program }', name: 'app_reservation', methods: ['GET'])]
    public function delete(TicketRepository $ticketRepository, $reservation,Program $program,EntityManagerInterface $entityManager): Response
    {
        $true=0;
        $allTicket=$reservation->getTickets();
        foreach ($allTicket as $t){
            if($t->getProgram==$program->getId()){
                $cart = new CartServices($ticketRepository,$entityManager,$t->getId());
                $cart->dellTicket();
                $true=1;
            }
        }

        if($true!=1){
            $ticket=new Ticket();
            $ticket->setProgram($program->getId());
            $ticket->setQteNormal(0);

            $reservation->setTicketsId($ticket->getId());

            $entityManager->persist($ticket);
            $entityManager->flush();

            $entityManager->persist($reservation);
            $entityManager->flush();
        }
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation' => $reservation,
        ]);
    }

    #[Route('/reservation/deleteAll/{ reservation }', name: 'app_reservation', methods: ['GET'])]
    public function deleteAll(Reservation $reservation,ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $cart = new CartServices($reservation);
        $cart->supprimeToutReserva();
        $entityManager->persist($reservation);
        $entityManager->flush();
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation' => $reservation,
        ]);
    }

    #[Route('/reservation/price/{ reservation }', name: 'app_reservation', methods: ['GET'])]
    public function price(TicketRepository $ticketRepository, $reservation,Program $program,EntityManagerInterface $entityManager): Response
    {
        $priceTotal=0;
        $allTicket=$reservation->getTickets();
        foreach ($allTicket as $t){
            if($t->getProgram==$program->getId()){
                $cart = new CartServices($ticketRepository,$entityManager,$t->getId());
                $priceTotal=$cart->getTotalPrice();
            }
        }

        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation' => $reservation,
            'price' => $priceTotal,
        ]);
    }
}