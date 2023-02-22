<?php

namespace App\Controller;

use App\Form\UpdateProfilFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'profil' => 'ProfilController',
        ]);
    }
    #[Route('/profil_update', name: 'app_profil_update')]
    public function update(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UpdateProfilFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Votre Profil est bien mis à jour !');

            return $this->redirectToRoute('app_profil');

        }

        return $this->render('profil/update.html.twig', [
            'profilupdate' => $form->createView(),
        ]);
    }

    #[Route('/profil_update_password', name: 'app_profil_update_password')]
    public function edit(
        UserPasswordHasherInterface $userPasswordHasher,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $user = $this->getUser();
        if ($request->isMethod('POST')){
            if($request->request->get('pass')==$request->request->get('pass1')){
                $user ->setPassword(
                    $userPasswordHasher->hashPassword(
                    $user,
                    $request->request->get('pass')
                ));
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('success', 'Password changé avec succès');
                return $this->redirectToRoute('app_profil');
            }
            else{
                $this->addFlash('error', 'Les deux Password ne sont pas identiques ! ');
            }
        }
        return $this->render('profil/editPassword.html.twig', [
            'PasswordUpdate' => 'ProfilController',
        ]);
    }
}

