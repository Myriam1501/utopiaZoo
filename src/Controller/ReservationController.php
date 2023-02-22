<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Reservation;
use App\Services\CartServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation', methods: ['GET'])]
    public function index(Request $request,ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $reserv = new Reservation();
        $reserv->setQteNormal(0);
        $reserv->setQteReduce(0);
        $program = new Program();
        $program->setDescriptionProgram("brrgsrbb dfbd");
        $program->setPrice(1234);
        $program->setAgeMin(2);
        $program->setTitle('utopia-fantastic');
        $reserv->addProgram($program);
        $entityManager->persist($reserv);
        $entityManager->flush();
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation' => $reserv,
        ]);
    }

    #[Route('/reservation/add/{ reservation }', name: 'app_reservation', methods: ['GET'])]
    public function add(Reservation $reservation,ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $cart = new CartServices($reservation);
        $cart->incrementeReservation();
        $entityManager->persist($reservation);
        $entityManager->flush();
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation' => $reservation,
        ]);
    }

    #[Route('/reservation/del/{ reservation }', name: 'app_reservation', methods: ['GET'])]
    public function delete(Reservation $reservation,ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $cart = new CartServices($reservation);
        $cart->supprimeReserva();
        $entityManager->persist($reservation);
        $entityManager->flush();
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
    public function price(Reservation $reservation,ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $cart = new CartServices($reservation);
        $cart->recupTotalApresTVA();
        $entityManager->persist($reservation);
        $entityManager->flush();
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation' => $reservation,
        ]);
    }
}