<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class InscriptionController extends AbstractController
{
    public function __construct(
        public EntityManagerInterface $entityManager,
    ){}
    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){


                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $this ->addFlash(
                    'Success',
                    'les informations de votre compte ont bien été enregistré !'
                );
            }
        $this->addFlash(
            'error',
            'Ce login existe déjà ! '
        );

        return $this->render('inscription/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
