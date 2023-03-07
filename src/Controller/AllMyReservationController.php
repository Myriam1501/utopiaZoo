<?php

namespace App\Controller;


use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllMyReservationController extends AbstractController
{
    #[Route('/all/my/reservation', name: 'app_all_my_reservation')]
    public function index(ReservationRepository $repository): Response
    {
        $rep=$repository->findAll();
        return $this->render('all_my_reservation/index.html.twig', [
            'controller_name' => 'AllMyReservationController',
            'reservation' => $rep,
        ]);
    }
}
