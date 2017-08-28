<?php
/**
 * Created by PhpStorm.
 * User: arczi
 * Date: 8/27/17
 * Time: 10:57 PM
 */

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

	public function testSearchByIdJoinedToPost()
	{
		$user = $this->em
			->getRepository(User::class)
			->loadUserByUsername('admin');

		var_dump($user->getId());
		$this->assertEquals(9, $user->getId());
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
