<?php

namespace App\Controller;

use App\Services\CartServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $cartServices;
    public function __construct(CartServices $cartServices)
    {
        $this->cartServices = $cartServices;
    }

    #[Route('/cart', name: 'app_cart')]
    public function index(CartServices $cartServices): Response
    {
        $cart = $cartServices->getFullCart();
        if (!isset($cart['products'])){
            return $this->redirectToRoute('app_homepage');
        }
        //$cartServices->addToCart(4);
        //dd($cartServices->getCart());//test ok pour affichage

        return $this->render('cart/index.html.twig', [
            'cart' => $cart
        ]);
    }


    #[Route('/cart/add/{id}', name: 'app_cartAdd')]
    public function addToCart($id): Response{
        //$cartServices->deleteCart();
        $this->cartServices->addToCart($id);
        //dd($cartServices->getFullCart());//test ok pour l'ajout
        return $this->redirectToRoute('app_cart');
        //return $this->render('cart/index.html.twig', [
        // 'controller_name' => 'CartController',]);
    }

    #[Route('/cart/delete/{id}', name: 'app_cartDelete')]
    public function deleteFromCart($id): Response{

        $this->cartServices->deleteFromCart($id);
        //dd($cartServices->getFullCart());//test ok pour le delete
        return $this->redirectToRoute('app_cart');
        //return $this->render('cart/index.html.twig', [
        //    'controller_name' => 'CartController',]);
    }


    #[Route('/cart/deleteAll/{id}', name: 'app_cartDeleteAll')]
    public function deleteAllToCart($id): Response{

        $this->cartServices->deleteAllToCart($id);
        //dd($cartServices->getFullCart());//test ok pour le delete
        return $this->redirectToRoute('app_cart');
        //return $this->render('cart/index.html.twig', [
        //    'controller_name' => 'CartController',]);
    }
}