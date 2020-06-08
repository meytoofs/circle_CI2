<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class SecurityControllerTest extends WebTestCase
{
    
    public function testDisplayLogin()
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseStatusCodeSame (Response :: HTTP_OK);
        
    }

    public function testLoginWithBadCredentials()
    {
        $client = static::createClient();
        $crawler=$client->request('GET', '/login');
        $form = $crawler->selectButton('login.btn_login')->form([
            'email' => 'john@doe.fr',
            'password' => 'password'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/login');
        $client->followRedirect();
        $this->assertSelectorExists('.alert.alert-danger');
        
    }
}

