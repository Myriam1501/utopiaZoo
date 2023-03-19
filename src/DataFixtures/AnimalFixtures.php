<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $animal = new Animal();
        $animal -> setName("Panda");

        $animal1 = new Animal();
        $animal1 -> setName("Tigre");

        $animal2 = new Animal();
        $animal2 -> setName("Lion");

        $animal3 = new Animal();
        $animal3 -> setName("Zebre");

        $animal4 = new Animal();
        $animal4 -> setName("Girafe");

        $manager->persist($animal);
        $manager->persist($animal1);
        $manager->persist($animal2);
        $manager->persist($animal3);
        $manager->persist($animal4);

        $manager->flush();
    }
}
