<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UsersAuthenticator;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_registre')]
    public function register(Request $request,
                             UserPasswordHasherInterface $userPasswordHasher,
                             UserAuthenticatorInterface $userAuthenticator,
                             UsersAuthenticator $authenticator,
                             EntityManagerInterface $entityManager,
                             SendMailService $mailService

    ): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                    $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('passWord')->getData()
                )
            );
            $user->setRoles(['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();
            $this ->addFlash(
                'success',
                'les informations de votre compte ont bien été enregistré !'
            );
            // do anything else you need here, like send an email

            $mailService->send(
                'no-reply-check-mail@utopiazoo.fr',
                $user->getEmail(),
                'Activation de votre compte sur le site UtopiaZoo',
                'sendmail',
                compact('user')
            );

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

}
