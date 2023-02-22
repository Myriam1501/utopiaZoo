<?php

namespace App\Controller;

use App\Form\UpdateProfilFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

    #[Route('/profil/update', name: 'profil_update', methods: ['GET', 'POST'])]
    public function update(Request $request,
    UserRepository $repository,
    EntityManagerInterface $entityManager
    ): Response
    {
        $form = $this->createForm(UpdateProfilFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form -> isValid()) {

            $user = $repository->findOneByEmail($form->get('email')->getData());

            if($user)
            {
                $user = $form->getData();
                $entityManager->persist($user);
                $entityManager-> flush();

                $this->addFlash('success', 'Modification réussi !');

                return $this->redirectRoute('app_profil');
            }
        }
        return $this->render('profil/update.html.twig', [
            'profilUpdate' => $form->createView(),
        ]);
    }
}

