<?php
namespace App\Services;

use App\Repository\ProgramRepository;
use  Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartServices{

    private $repoProduct;
    private $tva = 0.2;

    public function __construct(ProgramRepository $repoProduct){
        $this->repoProduct = $repoProduct;
    }

    public function addToCart($id){
        //mettre dans la reservation l'atttribut
        $cart = $this->getCart();
        if(isset($cart[$id])){
            //si il existe qte ++
            //$cart[$id]++;
        }else{
            // le produit n'est pas il va l'ajouter
            //$cart[$id] = 1;
        }
        $this->updateCart($cart);
    }

    public function deleteFromCart($id){
        $cart = $this->getCart();
        //produit est dans le panier
        if(isset($cart[$id])){
            //quantity de produit supérieur à 1
            if($cart[$id] > 1){
                $cart[$id]--;
            }else{
                unset($cart[$id]);
            }
            $this->updateCart($cart);
        }
    }

    public function deleteAllToCart($id){
        $cart = $this->getCart();
        //produit est dans le panier
        if(isset($cart[$id])){
            //tous supprimer
            unset($cart[$id]);
            $this->updateCart($cart);
        }
    }
    public function deleteCart(){
        $this->updateCart([]);
    }

    public function updateCart($cart){
        $this->session->set('cart', $cart);
        $this->session->set('cartData', $this->getFullCart());
    }

    public function getCart(){
        //recuperer un attribut dans la reservation
        return $this->session->get('cart',[]);
    }

    public function getFullCart(){
        $cart = $this->getCart();
        $fullCart = [];
        $quantity_cart = 0;
        $subTotal = 0;

        foreach ($cart as $id => $quantity) {
            $product = $this->repoProduct->find($id);
            if($product){
                //produit récupéré avec succès
                $fullCart['products'][] = [
                    "quantity" => $quantity,
                    "product" => $product
                ];
                $quantity_cart += $quantity;
                $subTotal += $quantity * $product->getPrice();
            }else{
                //identifiant incorrect
                $this->deleteFromCart($id);
            }
        }
        $fullCart['data'] = [
            "quantity_cart" => $quantity_cart,
            "subTotalHT" => $subTotal,
            "Taxe" => round($subTotal*$this->tva,2),
            "subTotalTTC" => round(($subTotal + ($subTotal*$this->tva)),2)
        ];
        return $fullCart;
    }

}


?>