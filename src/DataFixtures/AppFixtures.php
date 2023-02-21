<?php

namespace App\DataFixtures;

use App\Entity\Account;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $account = new Account();
        $account->setId(01)
            ->setName('dd');

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
