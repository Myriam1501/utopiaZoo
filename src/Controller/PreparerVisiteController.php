<?php

namespace App\Controller;

use App\Entity\Programme;
use App\Form\ProgrammeType;
use App\Repository\ProgrammeRepository;
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
    public function create(Request $request, ProgrammeFormHandler $programmeFormHandler): Response
    {
        $programme = new Programme();

        $form = $this->createForm(ProgrammeType::class, $programme);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ProgrammeFormHandler->handleForm($programme);
            $this->addFlash(
                'Votre programme à bien été créé'
            );
        }

        return $this->render('preparerVisite/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/preparerVisite/edit', name: 'app_preparerVisite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Programme $programme, ProgrammeFormHandler $programmeFormHandler): Response
    {

        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ProgrammeFormHandler->handleForm($programme);
            $this->addFlash(
                'Votre programme à bien été modifié'
            );
        }
        return $this->render('preparerVisite/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }




    #[Route('/preparerVisite/delete', name: 'app_preparerVisite_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request, Programme $programme, ProgrammeFormHandler $programmeFormHandler): Response
    {
        if(!$programme){
            return $this->redirectToRoute('app_preparerVisite');
            $this->addFlash(
                'programme non trouvé'
            );
        }

        $form =  $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ProgrammeFormHandler->remove($programme);
            $this->addFlash(
                'Votre programme à bien été supprimer'
            );
        }
        return $this->render('preparerVisite/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
