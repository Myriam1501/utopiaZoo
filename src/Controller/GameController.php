<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\PromotionRepository;
use App\Service\PromotionService;
use App\Service\ReservationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{

    #[Route('/game', name: 'app_game')]
    public function index(Request $request, PromotionRepository $promotionRepository): Response
    {
        $session = $request->getSession();
        $promotion=$promotionRepository->findOneBy(array());
        $promotionService=new PromotionService();
        $promotionService->setPromotion($session,$promotion);
        if(count($session->all())>0){
            return $this->render('game/index.html.twig', [
                'session' => $session,
            ]);
        } else{
            return $this->render('game/index.html.twig');
        }
    }




/// commenter tt
    #[Route('/game/add/{game} ', name: 'app_game_add')]
    public function add($game, Request $request): Response
    {
        $rep=$game;
        $session = $request->getSession();
        if($session->has($rep)){
            $qtn=$session->get($rep);
        }else{
            $qtn=0;
        }
        $session->set($rep,$qtn+1);
        return $this->render('game/index.html.twig', [
            'session' => $session,
        ]);
    }

    #[Route('/game/acheter', name: 'app_game_acheter')]
    public function acheter(Request $request,ProgramRepository $programRepository): Response
    {
        $programmes=$programRepository->findAll();
        $reservService=new ReservationService($request->getSession());
        $qtn=$reservService->getQuantity($programmes);
        $prixUnitaire=$reservService->getPriceByUnity($programmes);
        $prix=$reservService->applyPromo($request->getSession()->get("priceTotal"));
        return $this->render('facture/index.html.twig', [
            'programmes' => $programmes,
            'session' => $request->getSession(),
            'quantity' => $qtn,
            'price' => $prix,
            'priceWithoutQuantity' => $prixUnitaire,
        ]);
    }

    #[Route('/game/vider', name: 'app_game_vider')]
    public function vider(Request $request,ProgramRepository $programRepository): Response
    {
        $programmes=$programRepository->findAll();
        $session = $request->getSession();
        $session->clear();
        return $this->render('reserver/index.html.twig', [
            'programmes' => $programmes,
        ]);
    }

}
