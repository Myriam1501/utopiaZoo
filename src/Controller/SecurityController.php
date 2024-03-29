<?php

namespace App\Controller;

use App\Form\ResetPasswordForm;
use App\Form\ResetPasswordRequestFormType;
use App\Repository\UserRepository;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

     #[Route(path: '/connexion', name: 'app_login')]

    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('connexion/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/pwforget', name: 'app_passeword_forget')]
    public function index(Request $request, UserRepository $repository, TokenGeneratorInterface $tokenGenerator, EntityManagerInterface $entityManager, SendMailService $mailService): Response
    {
        $form = $this->createForm(ResetPasswordRequestFormType::class);
        $form ->handleRequest($request);
        if($form->isSubmitted() && $form ->isValid()){
            $user = $repository->findOneByEmail($form->get('email')->getData());
            if ($user){
                $token = $tokenGenerator -> generateToken();
                $user->setResetToken($token);
                $entityManager->persist($user);
                $entityManager->flush();
                $url = $this->generateUrl('reset_pass', ['token'=>$token], UrlGeneratorInterface::ABSOLUTE_URL);
                $context = compact('url', 'user');
                $mailService->send('no-reply-check-mail@utopiazoo.fr', $user->getEmail(), 'Réinitialisation votre mot de passe de votre compte sur le site UtopiaZoo', 'password_reset', $context);
                $this->addFlash('success', 'Email envoyé avec succès');
                return $this->redirectToRoute('app_login');
            }
            $this->addFlash('danger', 'Un problème est survenu !  ');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('passeword_forget/index.html.twig',['requestPassform' => $form->createView()]);
    }

    #[Route(path: '/oublipass/{token}', name: 'reset_pass')]
    public function reset(string $token, Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher):Response
    {
        $user = $userRepository->findOneByResetToken($token);
        if ($user){
            $form = $this->createForm(ResetPasswordForm::class);
            $form ->handleRequest($request);
            if($form->isSubmitted() && $form ->isValid()){
                $user->setResetToken('');
                $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('passWord')->getData()));
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('success', 'Password changé avec succès');
                return $this->redirectToRoute('app_login');
            }
            return $this->render('passeword_forget/reset_pass.html.twig',['Passform' => $form->createView()]);
        }
        $this->addFlash('danger', 'Un problème est survenu ! ');
        return $this->redirectToRoute('app_login');
    }
}
