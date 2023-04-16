<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PromotionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $promotion = new promotion();
        $promotion->setCodePromo('Promo5Game')
            ->setReduction(5)
        ;
        $manager->persist($promotion);
        for($i=0; $i<50; $i++){
            $promotionme = new promotion();
            $promotionme->setCodePromo('promo'.$i)
                ->setReduction(mt_rand(0,90));
            $manager->persist($promotion);
        }
        $manager->flush();
    }
}