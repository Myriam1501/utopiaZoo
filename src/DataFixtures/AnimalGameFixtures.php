<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AnimalGameFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $animal = new Animal();
        $animal->setName('Ane');
        $animal->setName('Belier');
        $animal->setName('Canard');
        $animal->setName('Dindon');
        $animal->setName('Elephant');
        $animal->setName('Faucon');
        $animal->setName('Girafe');
        $animal->setName('Hippopotame');
        $animal->setName('Iguane');
        $animal->setName('Jaguar');
        $animal->setName('Koala');
        $animal->setName('Lapin');
        $animal->setName('Mouton');
        $animal->setName('Nasique');
        $animal->setName('Ours');
        $animal->setName('Panthere');
        $animal->setName('Quokka');
        $animal->setName('Rhinocéros');
        $animal->setName('Singe');
        $animal->setName('Tortue');
        $animal->setName('Urial');
        $animal->setName('Vache');
        $animal->setName('Wallaby');
        $animal->setName('Xenope');
        $animal->setName('Zebre');

        $manager->persist($animal);

        $manager->flush();


    }
    /*
     * setprice(mt_rand(0,100))*/
}
