<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\Programme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $programme = new Programme();
        $programme->setTitreProgramme('Visite')
            ->setTimerProgrammer('1h');
        $manager->persist($programme);
        $manager->flush();
    }
}
