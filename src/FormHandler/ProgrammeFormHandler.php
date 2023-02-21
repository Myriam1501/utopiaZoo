<?php

namespace App\FormHandler;

use App\Entity\Figure;
use App\Entity\Programme;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

final class ProgrammeFormHandler
{
    public function __construct(
        public EntityManagerInterface $entityManager
    ) {}

    public function handleForm(Programme $programme): void
    {
        $user = new User();
        $user->setFirstName('Yassin');

        $this->entityManager->persist($user);

        $programme->setUser($user);

        $this->entityManager->persist($programme);
        $this->entityManager->flush();
    }
}