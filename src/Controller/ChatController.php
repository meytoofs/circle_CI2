<?php

namespace App\Controller;

<<<<<<< HEAD
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat", name="chat")
=======
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/chat", name="chat")
*/
class ChatController extends AbstractController
{
    /**
     * @Route("/", name="chat")
>>>>>>> 032de2f79c90fd718f99f8dcd3b8afa9081d5dc8
     */
    public function index()
    {
        return $this->render('chat/index.html.twig', [
<<<<<<< HEAD
            'controller_name' => 'ChatController',
=======
            
        ]);
    }
    /**
     * @Route("/room", name="room")
     */
    public function room()
    {
        return $this->render('chat/room.html.twig', [

        ]);
    }
    /**
     * @Route("/new", name="room_news", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        $room = new Room();
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($room);
            $entityManager->flush();

            return $this->redirectToRoute('');
        }

        return $this->render('chat/new.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="room_chat", methods={GET})
     */
    public function chatMessage(Request $request, Room $room): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($room);
            $entityManager->flush();

            return $this->render('chat/chat.html.twig', [

            ]);
        }

        return $this->render('chat/chat.html.twig', [
            'message' => $message,
            'room' =>$room,
>>>>>>> 032de2f79c90fd718f99f8dcd3b8afa9081d5dc8
        ]);
    }
}
