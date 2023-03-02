<?php

namespace App\Controller;


use App\Repository\AnimaleGameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Routing\Annotation\Route;

class Jeu6Controller extends AbstractController
{
    #[Route('/jeu6', name: 'app_jeu6')]
    public function index(AnimaleGameRepository $animaleGameRepository): Response
    {
        $cookie=new Cookie('user','john',time()+60);
        $res=new Response();
        $res->headers->setCookie( $cookie );
        $res->send();
        $nbr=rand(1,3);
        $val=$animaleGameRepository->find($nbr);
        return $this->render('jeu6/index.html.twig', [
            'controller_name' => 'Jeu6Controller',
            'animalImg' => $val,
            'cookie' => $res,
        ]);
    }
}
