<?php

namespace App\Controller;

use DateTime;
use App\Entity\Room;
use App\Form\RoomType;
use App\Entity\Message;
use App\Form\MessageType;
use App\Twig\UidExtension;
use App\Repository\RoomRepository;
use App\Repository\MessageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
* @Route("/chat")
*/
class ChatController extends AbstractController
{
    /**
     * @Route("/", name="rule")
     */
    public function index()
    {
        return $this->render('chat/index.html.twig', [
            
        ]);
    }
    /**
     * @Route("/room", name="room", methods={"GET"})
     */
    public function room(): Response
    {
        $rooms = $this->getDoctrine()
        ->getRepository(Room::class)
        ->findAll();
        $this->isGranted('POST_EDIT', $rooms);
        return $this->render('chat/room.html.twig', [
            'rooms' => $rooms,

        ]);
    }
    /**
     * @Route("/room/{id}", name="chat_show", methods={"GET"})
     */
    public function show(Room $room, RoomRepository $repository, Request $request, SerializerInterface $serializer, NormalizerInterface $normalizer)
    {
        $displayMessage = $repository->findAll();
        $messageNormalises =  $normalizer->normalize($displayMessage, null, ['groups' => 'room:Message']); //Normalise mon groupe dans mon objet 'Message' en array pour éviter les circular Reference
        $json = json_encode($messageNormalises); //serialise l'array en JSON 
        $response = $this->json($displayMessage, 200, [], ['groups' => 'room:Message']);
        $response = new JsonResponse($json, 200, [], true);
        return $this->render('chat/chat.html.twig', [
            'messages' => $displayMessage,
            'room' => $room,
        ]);
    }
    /**
     * @Route("/new", name="room_news", methods={"GET", "POST"})
     */
    public function new(Request $request, TranslatorInterface $translator): Response
    {
        $room = new Room();
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($room);
            $entityManager->flush();

            return $this->redirectToRoute('room');
        }

        return $this->render('chat/new.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }
}

