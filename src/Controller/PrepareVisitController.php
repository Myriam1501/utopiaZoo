<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use App\Services\CartServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrepareVisitController extends AbstractController
{

    #[Route('/prepareVisit', name: 'app_prepareVisit')]
    public function index(ProgramRepository $repository): Response
    {
        $programmes=$repository->findAll();

        return $this->render('prepareVisit/index.html.twig', [
            'programmes' => $programmes,
        ]);
    }

    #[Route('/prepareVisit/add/{id}', name: 'app_cartAdd')]
    public function addToCart(Program $id, CartServices $cartServices): Response{
        //$cartServices->deleteCart();
        $cartServices->addToCart($id);
        //dd($cartServices->getFullCart());//test ok pour l'ajout
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
        return $this->redirectToRoute('app_prepareVisit');
        //return $this->render('cart/index.html.twig', [
        //    'controller_name' => 'CartController.php',]);
    }

}
