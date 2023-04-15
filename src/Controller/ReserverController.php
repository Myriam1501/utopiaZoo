<?php

namespace App\Controller;


use App\Repository\ProgramRepository;
use App\Repository\PromotionRepository;
use App\Service\ReservationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ReserverController extends AbstractController
{
    private array $programmes;

    public function __construct(ProgramRepository $programmes)
    {
        $this->programmes=$programmes->findAll();
    }

    #[Route('/reserver', name: 'app_reserver')]
    public function index(Request $request): Response
    {
        $session=$request->getSession();
        if ($session->has("priceTotal")){
            return $this->render('reserver/index.html.twig', [
                'programmes' => $this->programmes,
                'session' => $session,
                'price' => $session->get('priceTotal'),
            ]);
        } else{
            return $this->render('reserver/index.html.twig', [
                'programmes' => $this->programmes,
            ]);
        }
    }

    #[Route('/reserver/add/{program} ', name: 'app_reserver_add')]
    public function add($program, Request $request,ProgramRepository $programRepository): Response
    {
        $pr=$programRepository->find($program);
        $reservService=new ReservationService($request->getSession());
        $prix=$reservService->addProgram($pr,$request);
        return $this->render('reserver/index.html.twig', [
            'programmes' => $this->programmes,
            'session' => $request->getSession(),
            'price' => $prix,
        ]);
    }

    #[Route('/reserver/add ', name: 'app_reserver_add_promotion')]
    public function addPromotion(Request $request,PromotionRepository $promotionRepository): Response
    {
        $session=$request->getSession();
        $promotion = $request->get('promo');
        $reservService=new ReservationService($session);
        $reservService->addPromotion($promotion,$promotionRepository);
        return $this->render('reserver/index.html.twig', [
            'controller_name' => 'ReserverController',
            'promotion'=>$promotion,
            'session' => $session,
            'programmes' => $this->programmes,
        ]);
    }

    #[Route('/reserver/acheter', name: 'app_reserver_acheter')]
    public function acheter(Request $request): Response
    {
        $reservService=new ReservationService($request->getSession());
        $qtn=$reservService->getQuantity($this->programmes);
        $prixUnitaire=$reservService->getPriceByUnity($this->programmes);
        $prix=$reservService->applyPromo($request->getSession()->get("priceTotal"));
        return $this->render('facture/index.html.twig', [
            'programmes' => $this->programmes,
            'session' => $request->getSession(),
            'quantity' => $qtn,
            'price' => $prix,
            'priceWithoutQuantity' => $prixUnitaire,
        ]);
    }

    #[Route('/reserver/vider', name: 'app_reserver_vider')]
    public function vider(Request $request): Response
    {
        $request->getSession()->clear();
        return $this->render('reserver/index.html.twig', [
            'programmes' => $this->programmes,
        ]);
    }


    #[Route('/reserver/dell/{program} ', name: 'app_reserver_dell')]
    public function dell(Request $request,$program,ProgramRepository $programRepository): Response
    {
        $reservService=new ReservationService($request->getSession());
        $theProgram=$programRepository->find($program);
        $prix=$reservService->deleteProgram($theProgram);
        return $this->render('reserver/index.html.twig', [
            'programmes' => $this->programmes,
            'session' => $request->getSession(),
            'price' => $prix,
        ]);
    }




}
