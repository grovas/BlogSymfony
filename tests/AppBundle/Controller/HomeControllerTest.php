<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\HomeController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
	public function testIndex()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/');

		$this->assertEquals(200, $client->getResponse()->getStatusCode());
		$this->assertContains('Witamy w serwisie dla blogerów',
			$crawler->filter('h1')->text());
	}
}
