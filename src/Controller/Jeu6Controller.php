<?php

namespace App\Controller;


use App\Repository\AnimaleGameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Jeu6Controller extends AbstractController
{
    #[Route('/jeu6', name: 'app_jeu6')]
    public function index(AnimaleGameRepository $animalGameRepository,Request $request): Response
    {
        $session = $request->getSession();
        $first=$animalGameRepository->findOneBy(array(),array('id' => 'DESC'));
        $last=$animalGameRepository->findOneBy(array(),array('id' => 'ASC'));
        $nbr=rand($first->getId(),$last->getId());
        $val=$animalGameRepository->find($nbr);
        return $this->render('jeu6/index.html.twig', [
            'controller_name' => 'Jeu6Controller',
            'animalImg' => $val,
            'session' => $session,
        ]);
    }
}
