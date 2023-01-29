<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Jeu2Controller extends AbstractController
{
    #[Route('/jeu2', name: 'app_jeu2')]
    public function index(AnimalRepository $animalRepository): Response
    {
        $val=$animalRepository->find(1);
        return $this->render('jeu2/index.html.twig', [
            'controller_name' => 'Jeu2Controller',
            'animal' => $val->getSound(),
        ]);
    }
}
