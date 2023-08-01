<?php

namespace App\Controller;

use App\Entity\Planning;
use App\Form\PlanningType;
use App\Repository\InternRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlanningController extends AbstractController
{
    #[Route('/planning', name: 'app_planning')]
    public function index(InternRepository $planningRepository): Response
    {

        $plannings = $planningRepository->findBy([], ["id" => "ASC"]);

        return $this->render('planning/index.html.twig', [
            'plannings' => $plannings,
        ]);

        
    }

    #[Route('/planning/new', name: 'new_planning')]

    #[Route('/planning/{id}/edit', name: 'edit_planning')]

    public function new_edit(Planning $planning = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$planning) {

            $planning = new Planning();
            // ...
        
        }

        $form = $this->createForm(PlanningType::class, $planning);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $planning = $form->getData();
            $entityManager->persist($planning);
            $entityManager->flush();

            return $this->redirectToRoute('app_session');
        }

        return $this->render('planning/new.html.twig', [
            'formAddPlanning' => $form,
            
            'edit' => $planning->getId()
        ]);

    }

    #[Route('/planning/{id}/delete', name: 'delete_planning')]

    public function delete(Planning $planning, EntityManagerInterface $entityManager) {
        
        $entityManager->remove($planning);

        $entityManager->flush();

        return $this->redirectToRoute('show_session');
        
    }
}
