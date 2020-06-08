<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PageControllerTest extends WebTestCase
{
    public function testAccueilPage(){
    $client = static::createClient();
    $client->request('GET', '/accueil');

    $this->assertResponseStatusCodeSame (Response :: HTTP_OK);
    $this->assertSelectorTextContains( 'h1','page accueil');


}
}

