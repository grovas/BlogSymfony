<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomeController extends Controller
{
    public function indexAction(UserPasswordEncoderInterface $passwordEncoder)
    {
    	$em = $this->getDoctrine()
			->getManager()
			->getRepository(User::class)
			->loadUserByUsername('admin');

    	if (!$em) {
    		$userAdmin = new User();
			$password = $passwordEncoder
				->encodePassword($userAdmin,'admin');
    		self::makeAdminAccount($password, $userAdmin);
		}

        return $this->render('home/index.html.twig', [
			'base_dir' => realpath($this
					->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
		]);
    }

	/**
	 * Fuction check if user admin is created and if not - create acoount admin
	 *
	 * @param $password
	 * @param User $userAdmin
	 */
    public function makeAdminAccount($password, User $userAdmin)
	{
		$em = $this->getDoctrine()
			->getManager()
			->getRepository(User::class)
			->loadUserByUsername('admin');

		if (!$em) {
			$userAdmin->setRoles('ROLE_ADMIN');
			$userAdmin->setIsActive(true);
			$userAdmin->setEmail('admin@admin.on');
			$userAdmin->setUsername('admin');
			$userAdmin->setPhone('112 112 121');
			$userAdmin->setToken(sha1(uniqid($userAdmin
				->getUsername(), true)));
			$userAdmin->setTstamp(time()+(7*24*60*60));
			$userAdmin->setPassword($password);
			$em = $this->getDoctrine()->getManager();
			$em->persist($userAdmin);
			$em->flush();
		}
	}
}
