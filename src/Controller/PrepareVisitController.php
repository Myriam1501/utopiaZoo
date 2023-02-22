<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Reservation;
use App\Entity\Ticket;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use App\Repository\TicketRepository;
use App\Services\CartServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrepareVisitController extends AbstractController
{

    #[Route('/prepareVisit/reservation', name: 'app_prepareVisit_reservation')]
    public function index(ProgramRepository $repository,EntityManagerInterface $entityManager): Response
    {
        $programmes=$repository->findAll();
        $reservation = new Reservation();
        $entityManager->persist($reservation);
        $entityManager->flush();

        return $this->render('prepareVisit/index.html.twig', [
            'programmes' => $programmes,
            'reservation' => $reservation,
        ]);
    }

    #[Route('/prepareVisit', name: 'app_prepareVisit')]
    public function index2(ProgramRepository $repository,Reservation $reservation,EntityManagerInterface $entityManager): Response
    {
        $programmes=$repository->findAll();

        return $this->render('prepareVisit/index.html.twig', [
            'programmes' => $programmes,
            'reservation' => $reservation,
        ]);
    }

    #[Route('/prepareVisit/add/{ reservation }/{ program }', name: 'app_cartAdd')]
    public function addToCart(TicketRepository $ticketRepository, $reservation,Program $program,EntityManagerInterface $entityManager): Response{
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

        return $this->redirectToRoute('app_prepareVisit');
        //return $this->render('cart/index.html.twig', [
        // 'controller_name' => 'CartController.php',]);
    }

    #[Route('/prepareVisit/delete/{ reservation }/{ program }', name: 'app_cartAdd')]
    public function delete(TicketRepository $ticketRepository, $reservation,Program $program,EntityManagerInterface $entityManager): Response{
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

        return $this->redirectToRoute('app_prepareVisit');
        //return $this->render('cart/index.html.twig', [
        // 'controller_name' => 'CartController.php',]);
    }

    #[Route('/prepareVisit/delete/{id}', name: 'app_cartDelete')]
    public function deleteFromCart($id): Response{

        $this->cartServices->deleteFromCart($id);
        //dd($cartServices->getFullCart());//test ok pour le delete
        return $this->redirectToRoute('app_prepareVisit');
        //return $this->render('cart/index.html.twig', [
        //    'controller_name' => 'CartController.php',]);
    }

    #[Route('/prepareVisit/deleteAll/{id}', name: 'app_cartDeleteAll')]
    public function deleteAllToCart($id): Response{

        $this->cartServices->deleteAllToCart($id);
        //dd($cartServices->getFullCart());//test ok pour le delete
        return $this->redirectToRoute('app_prepareVisit');
        //return $this->render('cart/index.html.twig', [
        //    'controller_name' => 'CartController.php',]);
    }

    #[Route('/prepareVisit/price/{ reservation }', name: 'app_reservation', methods: ['GET'])]
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
