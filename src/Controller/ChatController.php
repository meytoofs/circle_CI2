<?php

namespace App\Controller;

use App\Entity\Room;
use App\Entity\Message;
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
     */
    public function index()
    {
        return $this->render('chat/index.html.twig', [
            
        ]);
    }
    /**
     * @Route("/room", name="room")
     */
    public function room(): Response
    {
        $rooms = $this->getDoctrine()
        ->getRepository(Room::class)
        ->findAll();
        return $this->render('chat/room.html.twig', [
            'rooms' => $rooms,

        ]);
    }
    /**
     * @Route("/new", name="room_news", methods={"GET", "POST"})
     */
    public function new(Request $request) 
    {
        // $room = new Room();
        // $form = $this->createForm(RoomType::class, $room);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($room);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('');
        // }

        // return $this->render('chat/new.html.twig', [
        //     'room' => $room,
        //     'form' => $form->createView(),
        // ]);
    }
    // /**
    //  * @Route("/{id}", name="room_chat", methods={GET})
    //  */
    // public function chatMessage(Request $request, Room $room): Response
    // {
    //     $message = new Message();
    //     $form = $this->createForm(MessageType::class, $message);
    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($room);
    //         $entityManager->flush();

    //         return $this->render('chat/chat.html.twig', [

    //         ]);
    //     }

    //     return $this->render('chat/chat.html.twig', [
    //         'message' => $message,
    //         'room' =>$room,
    //     ]);
    
}
