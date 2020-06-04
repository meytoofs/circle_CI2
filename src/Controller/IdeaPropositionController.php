<?php

namespace App\Controller;

use App\Entity\IdeaProposition;
use App\Form\IdeaPropositionType;
use App\Form\VoteType;
use App\Repository\IdeaPropositionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/idea/proposition")
 */
class IdeaPropositionController extends AbstractController
{
    /**
     * @Route("/", name="idea_proposition_index", methods={"GET"})
     */
    public function index(IdeaPropositionRepository $ideaPropositionRepository): Response
    {
        return $this->render('idea_proposition/index.html.twig', [
            'idea_propositions' => $ideaPropositionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="idea_proposition_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ideaProposition = new IdeaProposition();
        $form = $this->createForm(IdeaPropositionType::class, $ideaProposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ideaProposition);
            $entityManager->flush();
            return $this->redirectToRoute('idea_proposition_index');
        }

        return $this->render('idea_proposition/new.html.twig', [
            'idea_proposition' => $ideaProposition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="idea_proposition_show", methods={"GET"})
     */
    public function show(Request $request, IdeaProposition $ideaProposition): Response
    {
        $form = $this->createForm(VoteType::class, $ideaProposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('idea_proposition_show');
        }
        return $this->render('idea_proposition/show.html.twig', [
            'idea_proposition' => $ideaProposition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="idea_proposition_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IdeaProposition $ideaProposition): Response
    {
        $form = $this->createForm(IdeaPropositionType::class, $ideaProposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('idea_proposition_index');
        }

        return $this->render('idea_proposition/edit.html.twig', [
            'idea_proposition' => $ideaProposition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="idea_proposition_delete", methods={"DELETE"})
     */
    public function delete(Request $request, IdeaProposition $ideaProposition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ideaProposition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ideaProposition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('idea_proposition_index');
    }
}
