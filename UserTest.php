<?php

namespace App\Tests\Unit;

use App\Entity\Mark;
use App\Entity\User;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function getEntity(): User
    {
           
           $theAdmin = new User();

           $theAdmin ->setEmail('VisiteVIP')
            ->setname(53)
            ->setfirstname(true)
            ->setPassword(
            $this->userPasswordHasher->hashPassword($
           $theAdmin = , 'THEadmin')
					)
            ->setRoles(['ROLE_ADMIN']);
				return  $theAdmin;
    }

    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $user = $this->getEntity();

        $errors = $container->get('validator')->validate($user);

        $this->assertCount(0, $errors);
    }

    public function testInvalidEmail()
    {
        self::bootKernel();
        $container = static::getContainer();

        $user = $this->getEntity();
        $user->setTitle('');

        $errors = $container->get('validator')->validate($user);
        $this->assertCount(1, $errors);
    }

    
}
