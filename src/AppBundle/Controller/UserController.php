<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('/user/success.html.twig', array());
    }

    public function editUserDataAction(Request $request,
									   UserPasswordEncoderInterface $passwordEncoder)
	{
		$user = $this->getUser();
		$form = $this->createForm(UserType::class, $user);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$user = $form->getData();
			$password = $passwordEncoder
				->encodePassword($user, $user->getPassword());
			$user->setPassword($password);
			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();
			return $this->redirectToRoute('personal_index');
		}

		return $this->render('user/edit.html.twig',
			array('form' => $form->createView()));
	}
}
