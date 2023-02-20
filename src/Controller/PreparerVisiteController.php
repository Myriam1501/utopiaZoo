<?php

namespace App\Controller;

use App\Entity\Programme;
use App\Form\ProgrammeType;
use App\Repository\ProgrammeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PreparerVisiteController extends AbstractController
{
    #[Route('/preparerVisite', name: 'app_preparerVisite')]
    public function index(ProgrammeRepository $repository): Response
    {
        $programmes=$repository->findAll();

        return $this->render('preparerVisite/index.html.twig', [
            'programmes' => $programmes,
        ]);
    }


    #[Route('/preparerVisite/create', name: 'app_preparerVisite_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $programme = new Programme();

        $form = $this->createForm(ProgrammeType::class, $programme);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programme= $form -> getData();
            $manager->persist($programme);
            $manager->flush();
            return $this->redirectToRoute('app_preparerVisite');


        }

        return $this->render('preparerVisite/create.html.twig', [
        'form' => $form->createView()]);
    }


    #[Route('/preparerVisite/edit/{id}', name: 'app_preparerVisite_edit', methods: ['GET', 'POST'])]
    public function edit(Programme $programme, Request $request, EntityManagerInterface $manager): Response
    {

        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $programme= $form -> getData();
            $manager->persist($programme);
            $manager->flush();
            return $this->redirectToRoute('app_preparerVisite');

        }
        return $this->render('preparerVisite/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }




    #[Route('/preparerVisite/delete/{id}', name: 'app_preparerVisite_delete', methods: ['GET'])]
    public function delete(Programme $programme, EntityManagerInterface $manager): Response
    {

        $manager->remove($programme);
        $manager->flush();

        return $this->redirectToRoute('app_preparerVisite');
    }

}
