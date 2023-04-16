<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\PromotionRepository;
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

        $rep= 'gameReduction';
        $qtn = (bool) mt_rand(0, 1);
        $session->set($rep,$qtn);

        $index_name_code_promo = 'gameNameReduction';
        $nameCode= $promotion->getCodePromo();

        $session->set($index_name_code_promo,$nameCode);
        if(count($session->all())>0){
            return $this->render('game/index.html.twig', [
                'controller_name' => 'GameController',
                'session' => $session,
            ]);
        } else{
            return $this->render('game/index.html.twig', [
                'controller_name' => 'GameController',
            ]);
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
            'controller_name' => 'ReserverController',
            'session' => $session,
        ]);
    }

    #[Route('/game/acheter', name: 'app_game_acheter')]
    public function acheter(Request $request,ProgramRepository $programRepository): Response
    {
        $programmes=$programRepository->findAll();
        $session = $request->getSession();
        $qtn=0;
        $prix=0;
        $prixUnitaire=0;
        foreach ($programmes as $p){
            if($session->has($p->getTitle())){
                $uniqueQtn=$session->get($p->getTitle());
                $qtn=$qtn+$uniqueQtn;
                $prixUnitaire=$prixUnitaire+$p->getPrice();
                $prix=$prix+$uniqueQtn*$prixUnitaire;
            }
        }
        return $this->render('facture/index.html.twig', [
            'controller_name' => 'ReserverController',
            'programmes' => $programmes,
            'session' => $session,
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
            'controller_name' => 'ReserverController',
            'programmes' => $programmes,
        ]);
    }

}
