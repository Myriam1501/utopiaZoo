<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\AnimaleGame;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class GameFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $game=new AnimaleGame();

        $game->setImg1('\taquin\img1.jpg');
        $game->setImg2('\taquin\img2.jpg');
        $game->setImg3('\taquin\img3.jpg');
        $game->setImg4('\taquin\img4.jpg');
        $game->setImg5('\taquin\img5.jpg');
        $game->setImg6('\taquin\img6.jpg');
        $game->setImg7('\taquin\img7.jpg');
        $game->setImg8('\taquin\img8.jpg');
        $game->setImg9('\taquin\img9.jpg');

        $game1=new AnimaleGame();

        $game1->setImg1('\taquin\gir1.jpg');
        $game1->setImg2('\taquin\gir2.jpg');
        $game1->setImg3('\taquin\gir3.jpg');
        $game1->setImg4('\taquin\gir4.jpg');
        $game1->setImg5('\taquin\gir5.jpg');
        $game1->setImg6('\taquin\gir6.jpg');
        $game1->setImg7('\taquin\gir7.jpg');
        $game1->setImg8('\taquin\gir8.jpg');
        $game1->setImg9('\taquin\gir9.jpg');


        $game2=new AnimaleGame();

        $game2->setImg1('\taquin\chvr1.jpg');
        $game2->setImg2('\taquin\chvr2.jpg');
        $game2->setImg3('\taquin\chvr3.jpg');
        $game2->setImg4('\taquin\chvr4.jpg');
        $game2->setImg5('\taquin\chvr5.jpg');
        $game2->setImg6('\taquin\chvr6.jpg');
        $game2->setImg7('\taquin\chvr7.jpg');
        $game2->setImg8('\taquin\chvr8.jpg');
        $game2->setImg9('\taquin\chvr9.jpg');


        $manager->persist($game);

        $manager->flush();

        $manager->persist($game1);

        $manager->flush();

        $manager->persist($game2);

        $manager->flush();


    }
    /*
     * setprice(mt_rand(0,100))*/
}
