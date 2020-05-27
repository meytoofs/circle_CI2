<?php

namespace App\Emails;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mime\Email;

class MyEmailDuku
{
    /*
     * Add whatever properties & methods you need to hold the
     * data for this message class.
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail()
    {
        
        $email = (new Email())
        ->from('quentin.levis.simplon@gmail.com')
        ->to('quentin.levis.simplon@gmail.com')
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('Est ce que tu las vu mon cucurbitacé?')
        ->text('Il est beau mon cucurbitacé')
        ->html('<p>MON CUCURBITACE IL EST BOOOWWW !!!!</p>');
        $transport = new EsmtpTransport('null');
        $mailer = new Mailer($transport);
        $mailer->send($email);
    }
//     private $name;
//
//     
//    public function getName(): string
//    {
//        return $this->name;
//    }
}
