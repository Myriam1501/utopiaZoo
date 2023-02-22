<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Reservation;
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

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($reserv);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();


        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation' => $reserv,
        ]);
    }
}