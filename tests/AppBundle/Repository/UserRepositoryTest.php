<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
	/**
	 * @var |Doctrine|ORM|EntityManager
	 */
	private $em;

	/**
	 * {@inheritDoc}
	 */
	protected function setUp()
	{
		self::bootKernel();

		$this->em = static::$kernel->getContainer()
			->get('doctrine')
			->getManager();
	}

	public function testSearchUserByUsername()
	{
		$user = $this->em
			->getRepository(User::class)
			->loadUserByUsername('admin');

		var_dump($user->getRoles());
		$this->assertEquals(9, $user->getId());
		$this->assertEquals('admin@admin.on', $user->getEmail());
		$this->assertEquals("ROLE_ADMIN", $user->getRoles());
	}

	/**
	 * {@inheritDoc}
	 */
	protected function tearDown()
	{
		parent::tearDown();

		$this->em->close();
		$this->em = null; // avoid memory leaks
	}
}
