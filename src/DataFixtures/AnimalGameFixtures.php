<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AnimalGameFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $arrayAnimals=array("Ane","Belier","Canard","Dindon","Elephant","Faucon",
            "Girafe","Hippopotame","Iguane","Jaguar","Koala","Lapin","Mouton","Nasique","Ours",
            "Panthere","Quokka","Rhinoceros","Singe","Tortue","Urial","Vache","Wallaby","Xenope","Zebre");

        for($i=0;$i<sizeof($arrayAnimals);$i++)
        {
            $animalName=$arrayAnimals[$i];
            $newAnimal=new Animal();
            $newAnimal->setName($animalName);
            $newAnimal->setPicture("x");
            $manager->persist($newAnimal);
        }
        $manager->flush();

    }
    /*
     * setprice(mt_rand(0,100))*/
}
