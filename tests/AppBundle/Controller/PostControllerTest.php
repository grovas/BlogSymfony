<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
	public function testShowPost()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/');

		$this->assertGreaterThan(
			0,
			$crawler->filter('html:contains("logowania")')->count()
		);
	}


}
