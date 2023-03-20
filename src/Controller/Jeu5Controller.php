<?php

namespace App\Controller;


use App\Repository\AnimalRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Jeu5Controller extends AbstractController
{
    #[Route('/jeu5', name: 'app_jeu5')]
    public function index(AnimalRepository $animalRepository, Request $request): Response
    {
        $session = $request->getSession();
        $first=$animalRepository->findOneBy(array(),array('id' => 'DESC'));
        $last=$animalRepository->findOneBy(array(),array('id' => 'ASC'));
        $nbr=rand($first->getId(),$last->getId());
        $val=$animalRepository->find($nbr);
        $val=strtolower($val->getName());
        return $this->render('jeu5/index.html.twig', [
            'controller_name' => 'Jeu5Controller',
            'animalName' => $val,
            'session' => $session,
        ]);
    }

}
