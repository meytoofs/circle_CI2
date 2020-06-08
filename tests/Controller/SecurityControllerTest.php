<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class SecurityControllerTest extends WebTestCase
{
    public function testAccueilPage(){
    $client = static::createClient();
    $crawler = $client->request('GET', '/accueil');

    $this->assertResponseStatusCodeSame (Response :: HTTP_OK);
    $this->assertSelectorTextContains( 'h1','page accueil');


}
    




}

