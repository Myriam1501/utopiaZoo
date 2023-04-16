<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $button = $crawler->selectButton("");
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'BIENVENUE');
    }
}
