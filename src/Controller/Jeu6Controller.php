<?php

namespace App\Controller;

use App\Entity\AnimaleGame;
use App\Repository\AnimaleGameRepository;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Jeu6Controller extends AbstractController
{
    #[Route('/jeu6', name: 'app_jeu6')]
    public function index(AnimaleGameRepository $animaleGameRepository): Response
    {

        $nbr=rand(1,25);
        $val=$animaleGameRepository->find(3);
        return $this->render('jeu6/index.html.twig', [
            'controller_name' => 'Jeu6Controller',
            'animalImg' => $val,
        ]);
    }
}
