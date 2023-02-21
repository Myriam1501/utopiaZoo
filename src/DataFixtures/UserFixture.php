<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserFixture extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher,
        private SluggerInterface $slugger
    ){

    }
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin ->setEmail('admin@utopiazoo.fr');
        $admin->setfirstname('liu');
        $admin->setname('haoyue');
        $admin->setdddress('Tolbiac 75013 paris');
        $admin->setPassword(
            $this->userPasswordHasher->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $admin1 = new User();
        $admin1 ->setEmail('admin1@utopiazoo.fr');
        $admin1->setfirstname('OUNISSI');
        $admin1->setname('Myriam');
        $admin1->setdddress('Tolbiac 75013 paris');
        $admin1->setPassword(
            $this->userPasswordHasher->hashPassword($admin1, 'admin1')
        );
        $admin1->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);
        $manager->persist($admin1);
        $manager->flush();
    }
}
