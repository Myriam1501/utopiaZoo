<?php

namespace App\Controller;

use App\Entity\Program;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReserverController extends AbstractController
{
    #[Route('/reserver', name: 'app_reserver')]
    public function index(ProgramRepository $programRepository,EntityManagerInterface $entityManager): Response
    {
        $programmes=$programRepository->findAll();

        return $this->render('reserver/index.html.twig', [
            'controller_name' => 'ReserverController',
            'programmes' => $programmes,
        ]);
    }

    #[Route('/reserver/add/{program} ', name: 'app_reserver_add')]
    public function add($program,Request $request,ProgramRepository $programRepository,EntityManagerInterface $entityManager): Response
    {
        $pr=$programRepository->find($program);
        $rep=$pr->getTitle();
        $session = $request->getSession();
        if($session->has($rep)){
            $qtn=$session->get($rep);
        }else{
            $qtn=0;
        }
        $session->set($rep,$qtn+1);
        $programmes=$programRepository->findAll();
        return $this->render('reserver/index.html.twig', [
            'controller_name' => 'ReserverController',
            'programmes' => $programmes,
            'session' => $session,
        ]);
    }

    #[Route('/reserver/acheter', name: 'app_reserver_acheter')]
    public function acheter(Request $request,ProgramRepository $programRepository,EntityManagerInterface $entityManager): Response
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


    #[Route('/reserver/dell/{program} ', name: 'app_reserver_dell')]
    public function dell($program,Request $request,ProgramRepository $programRepository,EntityManagerInterface $entityManager): Response
    {
        $pr=$programRepository->find($program);
        $rep=$pr->getTitle();
        $session = $request->getSession();
        if($session->has($rep)){
            $qtn=$session->get($rep);
            $session->set($rep,$qtn-1);
        }
        $programmes=$programRepository->findAll();
        return $this->render('reserver/index.html.twig', [
            'controller_name' => 'ReserverController',
            'programmes' => $programmes,
            'session' => $session,
        ]);
    }




}
