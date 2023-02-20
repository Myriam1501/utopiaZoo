<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramManagementController extends AbstractController
{
    #[Route('/programManagement', name: 'app_programManagement')]
    public function index(ProgramRepository $repository): Response
    {
        $programmes=$repository->findAll();

        return $this->render('programManagement/index.html.twig', [
            'programmes' => $programmes,
        ]);
    }


    #[Route('/programManagement/create', name: 'app_programManagement_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $programme = new Program();

        $form = $this->createForm(ProgramType::class, $programme);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programme= $form -> getData();
            $manager->persist($programme);
            $manager->flush();
            return $this->redirectToRoute('app_programManagement');


        }

        return $this->render('programManagement/create.html.twig', [
            'form' => $form->createView()]);
    }


    #[Route('/programManagement/edit/{id}', name: 'app_programManagement_edit', methods: ['GET', 'POST'])]
    public function edit(Program $programme, Request $request, EntityManagerInterface $manager): Response
    {

        $form = $this->createForm(ProgramType::class, $programme);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $programme= $form -> getData();
            $manager->persist($programme);
            $manager->flush();
            return $this->redirectToRoute('app_programManagement');

        }
        return $this->render('programManagement/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }




    #[Route('/programManagement/delete/{id}', name: 'app_programManagement_delete', methods: ['GET'])]
    public function delete(Program $programme, EntityManagerInterface $manager): Response
    {

        $manager->remove($programme);
        $manager->flush();

        return $this->redirectToRoute('app_programManagement');
    }

}
