<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class CommunautéController extends AbstractController
{
    /**
     * @Route("/communaut/", name="communaut_")
     */
    public function index()
    {
        return $this->render('communauté/index.html.twig', [
            'controller_name' => 'CommunautéController',
        ]);
    }

     /**
     * @Route("/communaut/{id}", name="communaut_idea")
     */
    public function idea()
    {   $id = random_int(0, 100);
        return $this->render('communauté/idea.html.twig', [
            'id' => '$id',
        ]);
    }

      /**
     * @Route("/communaut/news", name="communaut_news")
     */
    public function news()
    {
        return $this->render('communauté/news.html.twig', [
            'controller_name' => 'CommunautéController',
        ]);
    }
}
