<?php

namespace App\Controller;

use App\Entity\Intern;
use App\Form\InternType;
use App\Repository\InternRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InternController extends AbstractController
{
    #[Route('/intern', name: 'app_intern')]
    public function index(InternRepository $internRepository): Response
    {
        $interns = $internRepository->findBy([], ["lastName" => "ASC"]);

        return $this->render('intern/index.html.twig', [
            'interns' => $interns,
        ]);
    }

    #[Route('/intern/new', name: 'new_intern')]
    #[Route('/intern/{id}/edit', name: 'edit_intern')]

    public function new_edit(Intern $intern = null, Request $request, EntityManagerInterface $entityManager): Response
    {

        if(!$intern) {

            $intern = new Intern();
            // ...
        }

        $form = $this->createForm(InternType::class, $intern);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $intern = $form->getData();
            
            $entityManager->persist($intern);
            
            $entityManager->flush();

            return $this->redirectToRoute('app_intern');
        }

        return $this->render('intern/new.html.twig', [
            'formAddIntern' => $form,
            'edit' => $intern->getId()
        ]);

        
    }

    #[Route('/intern/{id}/delete', name: 'delete_intern')]

    public function delete(Intern $intern, EntityManagerInterface $entityManager) {
        
        $entityManager->remove($intern);

        // "flush" --> Requête SQL "DELETE FROM"
        $entityManager->flush();


        return $this->redirectToRoute('app_intern');
        

    }
}
