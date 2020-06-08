<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder,MailerInterface $mailer )
    {   
        $user=new User();
        $form=$this->createForm(RegistrationFormType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
        $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setpassword($hash); 
            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash(
                'confirmation',
                'merci pour votre inscription');
            $email = new Email();
            $email->from('aida.djoudi@gmail.com')
            ->to($user->getEmail())
            ->cc('bar@example.com')
            ->bcc('baz@example.com')
            ->replyTo('fabien@symfony.com')
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Important Notification')
            ->text('salut')
            ->html('<h1>bienvenu</h1> <p>merci de votre inscription</p>');
            $mailer->send($email);
           



           // $manager->persist($article);
           // $manager->flush();
        return $this->redirectToRoute('app_login');
        
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
