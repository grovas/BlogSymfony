<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
	/**
	 * Loads the user for the given username.
	 *
	 * This method must return null if the user is not found.
	 *
	 * @param string $username The username
	 *
	 * @return UserInterface|null
	 */
	public function loadUserByUsername($username)
	{
		return $this->createQueryBuilder('u')
			->where('u.username = :username')
			->setParameter('username', $username)
			->getQuery()
			->getOneOrNullResult();
	}

//	/**
//	 * @param int $phone
//	 * @return phone number|null
//	 */
//	public function loadUserByPhone($phone)
//	{
//		return $this->createQueryBuilder('p')
//			->select('p.username')
//			->where('p.phone = :phone')
//			->setParameter('phone', $phone)
//			->getQuery()
//			->getOneOrNullResult();
//	}

	/**
	 *
	 * @param $userId
	 * @return null
	 */
	public function findOneByIdJoinedToPost($userId)
	{
		$query = $this->getEntityManager()
			->createQuery(
				'SELECT u, p FROM AppBundle:User u
				JOIN u.posts p
				WHERE u.id = :id'
			)->setParameter('id', $userId);

		try {
			return $query->getSingleResult();
		} catch (NoResultException $e) {
			return null;
		}
	}
}