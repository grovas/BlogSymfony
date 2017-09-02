<?php

namespace AppBundle\Menu;

use AppBundle\Entity\Post;
use AppBundle\Entity\User;
use AppBundle\Repository\PostRepository as PostRepository;
use Doctrine\Common\Persistence\ObjectRepository as ObjectRepository;
use Doctrine\ORM\Query;
use Knp\Bundle\MenuBundle\KnpMenuBundle;
use Knp\Menu\FactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class Builder
 * extends Controller because we want access to the User entity
 */
class Builder extends Controller
{
	/**
	 * @param FactoryInterface $factory
	 * @param array $options
	 * @return \Knp\Menu\ItemInterface
	 */
	public function mainMenu(FactoryInterface $factory, array $options)
	{
		/** @var FactoryInterface $factory */
		$menu = $factory->createItem('root');
		$menu->setChildrenAttribute('class', 'nav navbar-nav');
		$menu->addChild('Home', ['route' => 'home_index']);
		$menu->addChild('Logowanie', ['route' => 'login']);
		$menu->addChild('Rejestracja', ['route' => 'user_registration']);
		return $menu;
	}

	/**
	 * @param FactoryInterface $factory
	 * @param array $options
	 * @return \Knp\Menu\ItemInterface
	 */
	public function subMenu(FactoryInterface $factory, array $options)
	{
		/**
		 * Checking if today post is present
		 */

		/** @var User $user */
		$user = $this->getUser();
		/** @var \DateTime $today */
		$today = new \DateTime();
		/** @var \DateTime $todayFormat */
		$todayFormat = $today->format('Y-m-d');
		/** @var PostRepository|ObjectRepository $repository */
		$repository = $this->getDoctrine()
			->getRepository(Post::class);
		/** @var Query $query */
		$query = $repository->createQueryBuilder('t')
			->where('t.date = :date')
			->andWhere('t.user = :user')
			->setParameter('date', $todayFormat)
			->setParameter('user', $user->getId())
			->getQuery();
		/** @var KnpMenuBundle/ItemInterface $menu */
		$menu = $factory->createItem('child');
		$menu->setChildrenAttribute('class', 'nav navbar-nav');
		/**
		 * If query return null than print menu child 'New post'
		 * if not don't show them
		 */
		if (!$query->getResult()) {
			$menu->addChild('Nowy wpis',
				['route' => 'post_new_index']);
		}
		/**
		 * Checking if user has admin privileges
		 * If yes show Panel Admin option in the subMenu
		 */
		if ($user->getRoles()[0] == "ROLE_ADMIN") {
			$menu->addChild('Panel admina',
				['route' => 'adminpanel_view']);
		}
		$menu->addChild('Edycja danych blogera',
			['route' => 'user_edit']);
		$menu->addChild('Wyloguj', ['route' => 'logout']);
		return $menu;
	}
}