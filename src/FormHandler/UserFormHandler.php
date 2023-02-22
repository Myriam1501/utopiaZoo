<?php

namespace App\FormHandler;

use App\Entity\Figure;
use App\Entity\Programme;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

final class UserFormHandler
{
    public function __construct(
        public EntityManagerInterface $entityManager
    ) {}

    public function handleForm(Programme $programme): void
    {

        $programme = new Programme();
        $programme->setTitreProgramme('Yassin');

        $this->entityManager->persist($programme);

        $programme->setUser($user);

        $this->entityManager->persist($programme);
        $this->entityManager->flush();
    }
}