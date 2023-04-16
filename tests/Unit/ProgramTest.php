<?php

namespace App\Tests\Unit;

use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProgramTest extends KernelTestCase
{
    public function getEntity(): Program
    {
        return (new Program())
            ->setTitle('VisiteVIP')
            ->setPrice(53)
				 ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());
    }

    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $programme = $this->getEntity();

        $errors = $container->get('validator')->validate($programme);

        $this->assertCount(0, $errors);
    }
    

    
}
