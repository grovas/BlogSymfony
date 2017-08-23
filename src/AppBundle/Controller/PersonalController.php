<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use AppBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;

class PersonalController extends Controller
{
    public function indexAction()
    {
    	if (!$this->get('security.authorization_checker')
		->isGranted('IS_AUTHENTICATED_FULLY')) {
    		throw $this->createAccessDeniedException();
		}

		$user = $this->getUser();
    	$userId = $user->getId();

		$today = new \DateTime();
		$todayFormat = $today->format('Y-m-d');

		dump($today);
		dump($todayFormat);

		$repository = $this->getDoctrine()
			->getRepository(Post::class);

		$query = $repository->createQueryBuilder('t')
			->where('t.date = :date')
			->andWhere('t.user = :user')
			->setParameter('date', $todayFormat)
			->setParameter('user', $userId)
			->getQuery();

		dump($query->getResult());
		$notToday = false;

		if ($query->getResult()) {
			$notToday = true;
		}

		if (!empty($user)) {
			$user = $this->getDoctrine()
				->getRepository(User::class)
				->find($user->getId());

			$posts = $this->getDoctrine()
				->getRepository(Post::class)
				->createQueryBuilder('p')
				->select('p')
				->where('p.user = :id')
				->setParameter('id', $userId)
				->getQuery()
				->getResult();
		}

        return $this->render('personal/index.html.twig',
			array('user' => $user,
				  'posts' => $posts,
				'notToday' => $notToday,
				 ));
    }
}
