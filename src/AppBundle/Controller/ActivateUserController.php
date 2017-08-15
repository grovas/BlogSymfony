<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Psr\Log\LoggerInterface;

class ActivateUserController extends Controller
{
    public function checkTokenAction($token, LoggerInterface $log)
    {
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository(User::class)->findOneByToken($token);

		print_r($user);
		$log->debug('user', $user);

		if ($user){
			$user->setIsActive(true);
			//$em->persist($user);
			$em->flush();
			return $this->render('user/success.html.twig', array());
		}
		else {
			throw new Exception("Nie ma takiego tokena w systemie");
		}
    }
}
