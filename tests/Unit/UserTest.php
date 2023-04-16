<?php

namespace App\Tests\Unit;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserTest extends KernelTestCase
{

    private UserPasswordHasherInterface $userPasswordHasher;

    public function getEntity(): User
    {
        return (new User())
            ->setEmail('admin@utopiazoo.fr')
            ->setfirstname('liu')
            ->setname('haoyue')
            ->setdddress('Tolbiac 75013 paris')
            ->setRoles(['ROLE_ADMIN']);
    }

    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $user = $this->getEntity();

        $errors = $container->get('validator')->validate($user);

        $this->assertCount(0, $errors);
    }


    
}
