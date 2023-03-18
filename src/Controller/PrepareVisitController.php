<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Reservation;
use App\Entity\Ticket;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use App\Repository\ReservationRepository;
use App\Repository\TicketRepository;
use App\Services\CartServices;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrepareVisitController extends AbstractController
{

    #[Route('/prepareVisit/reservation', name: 'app_prepareVisit_reservation')]
    public function index(ProgramRepository $repository): Response
    {

        $programmes=$repository->findAll();
        return $this->render('prepareVisit/index.html.twig', [
            'programmes' => $programmes,
        ]);
    }
    #[Route('/prepareVisit', name: 'app_prepareVisit')]
    public function index2(ProgramRepository $repository,EntityManagerInterface $entityManager): Response
    {
        $programmes=$repository->findAll();

        return $this->render('prepareVisit/index.html.twig', [
            'programmes' => $programmes,
        ]);
    }

    #[Route('/prepareVisit/add/', name: 'app_cartAdd')]
    public function add(Request $request,TicketRepository $tr,EntityManagerInterface $entityManager,ProgramRepository $programRepository): Response{


        if ($request->isMethod('POST')){

            dd($request->request->get('quantite'));
        }



        $programmes=$programRepository->findAll();
       $reserva=new Reservation();
        $THEP=$programRepository->find(3);


            $ticket=new Ticket();
            $ticket->setProgram($THEP);
            $ticket->setQteNormal(1);
            $entityManager->persist($ticket);
            $entityManager->flush();

        $ticket1=new Ticket();
        $ticket1->setProgram($THEP);
        $ticket1->setQteNormal(1);
        $entityManager->persist($ticket1);
        $entityManager->flush();

        $ticket2=new Ticket();
        $ticket2->setProgram($THEP);
        $ticket2->setQteNormal(1);
        $entityManager->persist($ticket2);
        $entityManager->flush();

        $insertTicket=$tr->find($ticket->getId());
        $reserva->setTicketsId($insertTicket);
        $insertTicket1=$tr->find($ticket1->getId());
        $reserva->setTicketsId($insertTicket1);
        $insertTicket2=$tr->find($ticket2->getId());
        $reserva->setTicketsId($insertTicket2);


            $entityManager->persist($reserva);
            $entityManager->flush();


        return $this->render('prepareVisit/index.html.twig', [
            'programmes' => $programmes,
        ]);
        //return $this->redirectToRoute('app_prepareVisit');
        //return $this->render('cart/index.html.twig', [
        // 'controller_name' => 'CartController.php',]);
    }

    #[Route('/prepareVisit/delete/{ reservation }/{ program }', name: 'app_cartDell')]
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
        //return $this->redirectToRoute('app_prepareVisit');
        return $this->render('prepareVisit/index.html.twig');
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
