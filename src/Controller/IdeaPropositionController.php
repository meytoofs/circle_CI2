<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\IdeaProposition;
use App\Entity\NoteHistory;
use App\Form\IdeaPropositionType;
use App\Form\SearchDataType;
use App\Form\SearchForm;
use App\Form\VoteType;
use App\Repository\IdeaPropositionRepository;
use App\Repository\NoteHistoryRepository;
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
    public function index(IdeaPropositionRepository $repository, Request $request): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchDataType::class, $data);
        $form-> handleRequest($request);
        [$min, $max] = $repository->findMinMax($data);
        $idea = $repository->findSearch($data);
        $ideas = $this->getDoctrine()->getRepository(IdeaProposition::class)->findAll();
        return $this->render('idea_proposition/index.html.twig', [
            'idea_propositions' => $ideas,
            'idea_propositions' => $idea,
            'form' => $form->createView(),
            'min' => $min,
            'max' => $max,
            
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
            $ideaProposition->setUser($this->getUser());
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
     * @Route("/{id}", name="idea_proposition_show", methods={"GET", "POST"})
     */
    public function show(Request $request, IdeaProposition $ideaProposition, NoteHistoryRepository $repository): Response
    {
        $id = $ideaProposition->getId();
        $total_score = $repository->getAVG($id);
        $note = new NoteHistory();
        $note->setIdeaProposition($ideaProposition);
        $form = $this->createForm(VoteType::class, $note, [
            // 'id' => $id,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($note);
            $entityManager->flush();
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('idea_proposition_index');
        }
        return $this->render('idea_proposition/show.html.twig', [
            'idea_proposition' => $ideaProposition,
            'form' => $form->createView(),
            'total_score' => $total_score,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="idea_proposition_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IdeaProposition $ideaProposition): Response
    {
        $this->denyAccessUnlessGranted('edit', $ideaProposition);

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
        $this->denyAccessUnlessGranted('delete', $ideaProposition);
        if ($this->isCsrfTokenValid('delete'.$ideaProposition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ideaProposition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('idea_proposition_index');
    }
}
