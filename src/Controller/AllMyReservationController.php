<?php

namespace App\Controller;


use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllMyReservationController extends AbstractController
{
    #[Route('/all/my/reservation', name: 'app_all_my_reservation')]
    public function index(ReservationRepository $repository): Response
    {
        $user=$this->getUser();
        $rep = $repository->findReservationsByUser($user->getId());
        return $this->render('all_my_reservation/index.html.twig', [
            'controller_name' => 'AllMyReservationController',
            'reservation' => $rep,
        ]);
    }
}
