<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PromotionService
{

    public function setPromotion(SessionInterface $session, $promotion)
    {
        $rep= 'gameReduction';
        $qtn = (bool) mt_rand(0, 1);
        $session->set($rep,$qtn);
        $index_name_code_promo = 'gameNameReduction';
        $nameCode= $promotion->getCodePromo();
        $session->set($index_name_code_promo,$nameCode);
    }

}