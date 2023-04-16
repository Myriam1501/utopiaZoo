<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{

    private Generator $faker;
    public function __construct()
    {
        $this -> faker =Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {

        $programme = new Program();
        $programme->setTitle('Visite')
            ->setPrice(mt_rand(0,100))
        ;
        $manager->persist($programme);
        $programmes=array();
        $count=0;
        for($i=0; $i<50; $i++){
            $programme = new Program();
            $word=$this->faker->word();
            while(in_array($word,$programmes)){
                $word=$this->faker->word();
            }
            $programmes[$count]=$word;
            $count++;
            $programme->setTitle($word)
                ->setPrice(mt_rand(0,100));
            $manager->persist($programme);
        }
        $manager->flush();
    }
    /*
     * setprice(mt_rand(0,100))*/
}
