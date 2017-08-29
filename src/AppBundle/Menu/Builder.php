<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Builder extends Controller
{
	public function mainMenu(FactoryInterface $factory, array $options)
	{
		$menu = $factory->createItem('root');
		$menu->setChildrenAttribute('class', 'nav navbar-nav');
		$menu->addChild('Home', ['route' => 'home_index']);
		$menu->addChild('Logowanie', ['route' => 'login']);
		$menu->addChild('Rejestracja', ['route' => 'user_registration']);
		return $menu;
	}

	public function subMenu(FactoryInterface $factory, array $options)
	{
		$user = $this->getUser();



		dump($user->getRoles());
		$menu = $factory->createItem('child');
		$menu->setChildrenAttribute('class', 'nav navbar-nav');
		$menu->addChild('Nowy wpis', ['route' => 'post_new_index']);
		if ($user->getRoles()[0] == "ROLE_ADMIN") {
			$menu->addChild('Panel admina', ['route' => 'adminpanel_view']);
		}
		$menu->addChild('Edycja danych blogera', ['route' => 'user_edit']);
		$menu->addChild('Wyloguj', ['route' => 'logout']);
		return $menu;
	}
}