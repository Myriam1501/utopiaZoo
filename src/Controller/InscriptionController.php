<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class InscriptionController extends AbstractController
{
    public function __construct(
        public EntityManagerInterface $entityManager,
    ){}
    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request): Response
    {
        $account = new Account();
        $form = $this->createForm(InscriptionType::class, $account);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($account);
            $this->entityManager->flush();
        }
        return $this->render('inscription/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
