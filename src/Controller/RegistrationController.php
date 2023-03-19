<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\UsersAuthenticator;
use App\Service\JWTservice;
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
                             SendMailService $mailService,
                             JWTservice $JWTService

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
            // Générer le JWT de l'utilisateur.
            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];

            // On crée le Payload
            $payload = [
                'user_id' => $user->getId()
            ];

            // On génère le token
            $token = $JWTService->generate($header, $payload, $this->getParameter('app.jwtsecret'));

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
                compact('user', 'token')
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

    #[Route('/check/{token}', name: 'check_user')]
    public function check($token, JWTService $JWTservice, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        //On vérifie si le token est valide, n'a pas expiré et n'a pas été modifié
        if($JWTservice->isValid($token) && !$JWTservice->isExpired($token) && $JWTservice->check($token, $this->getParameter('app.jwtsecret'))){
            // On récupère le payload
            $payload = $JWTservice->getPayload($token);

            // On récupère le user du token
            $user = $userRepository->find($payload['user_id']);

            //On vérifie que l'utilisateur existe et n'a pas encore activé son compte
            if($user && !$user->isCheckEmail()){
                $user->setCheckEmail(true);
                $entityManager->flush($user);
                $this->addFlash('success', 'Utilisateur activé');
                return $this->redirectToRoute('app_homepage');
            }
        }
        // Ici un problème se pose dans le token
        $this->addFlash('danger', 'Le token est invalide ou a expiré');
        return $this->redirectToRoute('app_login');
    }

    #[Route('/renvoicheck', name: 'resend_check')]
    public function resend(JWTService $JWTservice, SendMailService $mailService, UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        if(!$user){
            $this->addFlash('danger', 'Vous devez être connecté pour accéder à cette page');
            return $this->redirectToRoute('app_login');
        }

        if($user->isCheckEmail()){
            $this->addFlash('warning', 'Cet utilisateur est déjà activé');
            return $this->redirectToRoute('app_homepage');
        }

        // On génère le JWT de l'utilisateur
        // On crée le Header
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];

        // On crée le Payload
        $payload = [
            'user_id' => $user->getId()
        ];

        // On génère le token
        $token = $JWTservice->generate($header, $payload, $this->getParameter('app.jwtsecret'));

        // On envoie un mail
        $mailService->send(
            'no-reply-check-mail@utopiazoo.fr',
            $user->getEmail(),
            'Activation de votre compte sur le site UtopiaZoo',
            'sendmail',
            compact('user', 'token')
        );
        $this->addFlash('success', 'Email de vérification envoyé');
        return $this->redirectToRoute('app_homepage');
    }

}
