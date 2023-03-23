<?php

namespace App\Controller;

use App\Entity\Program;
use App\Repository\ProgramRepository;
use App\Repository\PromotionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReserverController extends AbstractController
{
    #[Route('/reserver', name: 'app_reserver')]
    public function index(Request $request,ProgramRepository $programRepository,EntityManagerInterface $entityManager): Response
    {
        $programmes=$programRepository->findAll();
        $session = $request->getSession();
        if ($session->has("priceTotal")){
            $price=$session->get('priceTotal');
        }

        if(count($session->all())>0){
            return $this->render('reserver/index.html.twig', [
                'controller_name' => 'ReserverController',
                'programmes' => $programmes,
                'session' => $session,
                'price' => $price,

            ]);
        } else{
            return $this->render('reserver/index.html.twig', [
                'controller_name' => 'ReserverController',
                'programmes' => $programmes,
            ]);
        }
    }

    #[Route('/reserver/add/{program} ', name: 'app_reserver_add')]
    public function add($program, Request $request,ProgramRepository $programRepository,EntityManagerInterface $entityManager): Response
    {

        $pr=$programRepository->find($program);
        $rep=$pr->getTitle();

        $session = $request->getSession();
        if($request->get('promo')==='codepromo'){
            $quantity=-5;
            $session->set('code-promo',$quantity);
        }
        else{

            if($session->has($rep)){
                $quantity=$session->get($rep);
            }else{
                $quantity=0;
            }
            $session->set($rep,$quantity+1);
        }

        $programmes=$programRepository->findAll();
        if($session->has("priceTotal")){
            $prix=$session->get('priceTotal');
        }
        else{
            $prix=0;
        }
            if($session->has($pr->getTitle())){
                $prixUnitaire=$pr->getPrice();
                $prix=$prix+$prixUnitaire;
            }


        $promo = 'promo';
        if($session->has($promo)){
            $prix=$prix-($prix*($session->get($promo)/100));
        }
        $session->set("priceTotal",$prix);

        return $this->render('reserver/index.html.twig', [
            'controller_name' => 'ReserverController',
            'programmes' => $programmes,
            'session' => $session,
            'price' => $prix,
        ]);
    }

    #[Route('/reserver/add ', name: 'app_reserver_add_promotion')]
    public function addPromotion(Request $request,PromotionRepository $promotionRepository,ProgramRepository $programRepository): Response
    {
        $session = $request->getSession();
        $programmes=$programRepository->findAll();
        $promotion = $request->get('promo');
        $pr = $promotionRepository->findBy(['code_promo'=> $promotion]);
        if(count($pr)>0){
            $promoBdd= $pr[0];
            $rep='promo';


            if($rep!=null){


                if($session->has($rep)){
                    $qtn=$session->get($rep);
                }else{
                    $qtn=$promoBdd->getReduction();
                }
                $session->set($rep,$qtn);
            }

        }

        else{

            $this->addFlash(
                'notice',
                'code promo incorrect'
            );
        }

        return $this->render('reserver/index.html.twig', [
            'controller_name' => 'ReserverController',
            'promotion'=>$promotion,
            'session' => $session,
            'programmes' => $programmes,
        ]);
    }

    #[Route('/reserver/acheter', name: 'app_reserver_acheter')]
    public function acheter(Request $request,ProgramRepository $programRepository,EntityManagerInterface $entityManager): Response
    {
        $programmes=$programRepository->findAll();
        $session = $request->getSession();
        $qtn=0;
        $prix=$session->get("priceTotal");
        $prixUnitaire=0;
        foreach ($programmes as $p){
            if($session->has($p->getTitle())){
                $uniqueQtn=$session->get($p->getTitle());
                $qtn=$qtn+$uniqueQtn;
                $prixUnitaire=$prixUnitaire+$p->getPrice();
            }
        }

        $promo = 'promo';
        if($session->has($promo)){
            $prix=$prix-($prix*($session->get($promo)/100));

        }

        $session->set("priceTotal",$prix);
        return $this->render('facture/index.html.twig', [
            'controller_name' => 'ReserverController',
            'programmes' => $programmes,
            'session' => $session,
            'quantity' => $qtn,
            'price' => $prix,
            'priceWithoutQuantity' => $prixUnitaire,
        ]);

    }

    #[Route('/reserver/vider', name: 'app_reserver_vider')]
    public function vider(Request $request,ProgramRepository $programRepository,EntityManagerInterface $entityManager): Response
    {
        $programmes=$programRepository->findAll();
        $session = $request->getSession();
        $session->clear();
        return $this->render('reserver/index.html.twig', [
            'controller_name' => 'ReserverController',
            'programmes' => $programmes,
        ]);
    }


    #[Route('/reserver/dell/{program} ', name: 'app_reserver_dell')]
    public function dell($program,Request $request,ProgramRepository $programRepository,EntityManagerInterface $entityManager): Response
    {
        $pr=$programRepository->find($program);
        $rep=$pr->getTitle();
        $session = $request->getSession();
        if($session->has($rep)){
            if($session->get($rep)!=0){
                $qtn=$session->get($rep);
                $session->set($rep,$qtn-1);
            }
        }

        $programmes=$programRepository->findAll();
        if($session->has("priceTotal")){
            $prix=$session->get('priceTotal');
        }
        else{
            $prix=0;
        }
        if($session->has($pr->getTitle())){
            $prixUnitaire=$pr->getPrice();
            $prix=$prix-$prixUnitaire;
        }


        $promo = 'promo';
        if($session->has($promo)){
            $prix=$prix-($prix*($session->get($promo)/100));
        }
        $session->set("priceTotal",$prix);

        return $this->render('reserver/index.html.twig', [
            'controller_name' => 'ReserverController',
            'programmes' => $programmes,
            'session' => $session,
            'price' => $prix,
        ]);
    }




}
