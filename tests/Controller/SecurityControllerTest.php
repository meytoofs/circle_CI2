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
        $this->assertSelectorNotExists('.alert.alert-danger');
        
    }

    public function testLoginWithBadCredentials()
    {
        $client = static::createClient();
        $crawler=$client->request('GET', '/login');
        $form = $crawler->selectButton('login')->form([
            'username' => 'sanae',
            'password' => 'fakerfixture'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/login');
        $client->followRedirect();
        $this->assertSelectorExists('.alert.alert-danger');
        
    }
    public function testSuccessfullLogin () 
    {
   
        $client = static::createClient();
        $csrfToken = $client->getContainer()->get('security.csrf.token_manager')->getToken('authenticate');
        $client->request('POST', '/login', [
            '_csrf_token' => $csrfToken,
            'username' => 'douda',
            'password' => 'aidaaida'
        ]);
        
    
        $this->assertResponseRedirects('/accueil');
    }
}

