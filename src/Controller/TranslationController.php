<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class TranslationController extends AbstractController
{
    /**
     * @Route("/translation", name="translation")
     */
    public function index(TranslatorInterface $translator)
    {
        echo $translator->trans('num_of_apples', [
            'apples' => 'one',
        ],  'messages', 'fr');
        $theo = $translator->trans('coucou', [
            'name' => 'Théo Duku'
        ],  'messages', 'fr');
        return $this->render('translation/index.html.twig', [
            'controller_name' => 'TranslationController',
            'theo' => $theo,
        ]);
    }
}
