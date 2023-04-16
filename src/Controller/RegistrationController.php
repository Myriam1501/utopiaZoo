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
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UsersAuthenticator $authenticator, EntityManagerInterface $entityManager, SendMailService $mailService, JWTservice $JWTService): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('passWord')->getData()));
            $user->setRoles(['ROLE_USER']);
            $entityManager->persist($user);
            $entityManager->flush();
            $header = ['typ' => 'JWT', 'alg' => 'HS256'];
            $payload = ['user_id' => $user->getId()];
            $token = $JWTService->generate($header, $payload, $this->getParameter('app.jwtsecret'));
            $this ->addFlash('success', 'les informations de votre compte ont bien été enregistré !');
            $mailService->send('no-reply-check-mail@utopiazoo.fr', $user->getEmail(), 'Activation de votre compte sur le site UtopiaZoo', 'sendmail', compact('user', 'token'));
            return $userAuthenticator->authenticateUser($user, $authenticator, $request);
        }
        return $this->render('registration/register.html.twig', ['registrationForm' => $form->createView(),]);
    }

    #[Route('/check/{token}', name: 'check_user')]
    public function check($token, JWTService $JWTservice, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        if($JWTservice->isValid($token) && !$JWTservice->isExpired($token) && $JWTservice->check($token, $this->getParameter('app.jwtsecret'))){
            $payload = $JWTservice->getPayload($token);
            $user = $userRepository->find($payload['user_id']);
            if($user && !$user->isCheckEmail()){
                $user->setCheckEmail(true);
                $entityManager->flush($user);
                $this->addFlash('success', 'Utilisateur activé');
                return $this->redirectToRoute('app_homepage');
            }
        }
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
        $header = ['typ' => 'JWT', 'alg' => 'HS256'];
        $payload = ['user_id' => $user->getId()];
        $token = $JWTservice->generate($header, $payload, $this->getParameter('app.jwtsecret'));
        $mailService->send('no-reply-check-mail@utopiazoo.fr', $user->getEmail(), 'Activation de votre compte sur le site UtopiaZoo', 'sendmail', compact('user', 'token'));
        $this->addFlash('success', 'Email de vérification envoyé');
        return $this->redirectToRoute('app_homepage');
    }

}
