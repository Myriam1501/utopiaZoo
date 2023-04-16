<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AnimalGameFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $arrayAnimals=array('\img','\chvr','\gir');
        foreach ($arrayAnimals as $animal)
        {
            $game=new AnimaleGame();
            for($i=1;$i<10;$i++)
            {
                $str='setImg';
                $str=$str.$i;
                $img='\taquin'.$animal.$i.'.jpg';
                $game->$str($img);
            }
            $manager->persist($game);
        }

        $manager->flush();
    }
    /*
     * setprice(mt_rand(0,100))*/
}
