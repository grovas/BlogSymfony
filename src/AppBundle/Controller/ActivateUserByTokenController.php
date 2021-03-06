<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Psr\Log\LoggerInterface;

class ActivateUserByTokenController extends Controller
{
    public function checkTokenAction($token, LoggerInterface $log)
    {
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository(User::class)
			->findOneByToken($token);

		if ($user){
			$user->setIsActive(true);
			$em->flush();
			return $this->render('user/success.html.twig', array());
		}
		else {
			throw new Exception("Nie ma takiego tokena w systemie");
		}
    }
}
