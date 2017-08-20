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

		if (!empty($user)) {
			$user = $this->getDoctrine()
				->getRepository(User::class)
				->find($user->getId());

			$posts = $this->getDoctrine()
				->getRepository(Post::class)
				->createQueryBuilder('p')
				->select('p')
				->where('p.user = :id')
				->setParameter('id', $user->getId())
				->getQuery()
				->getResult();
		}

        return $this->render('personal/index.html.twig',
			array('user' => $user,
				  'posts' => $posts,
				 ));
    }
}
