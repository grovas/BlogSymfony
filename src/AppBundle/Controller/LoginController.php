<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User as AppUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LoginController extends Controller
{
//	public function indexAction(Request $request)
//	{
//		$user = new AppUser();
//		$em = $this->getDoctrine()->getManager();
//		var_dump("user_dump".$user);
//
//		$form = $this->createFormBuilder($user)
//			->add('username', TextType::class)
//			->add('password', PasswordType::class)
//			->add('zaloguj',
//				SubmitType::class, array('label' => 'Zaloguj się'))
//			->getForm();
//
//		$form->handleRequest($request);
//		$user = $form->getData();
//
//		if (!$user instanceof AppUser) {
//			return;
//		}
//
//		if ($user->isActive()) {
//			throw new AccountDeletedException('...');
//		}
//
//		if ($form->isSubmitted() && $form->isValid() && !$user->isActive()) {
//
//			$em->persist($user);
//			$em->flush();
//
//			return $this->redirectToRoute('/personal/index');
//		}
//
//		return $this->render('login/login_form.html.twig',
//			array('form' =>$form->createView(),
//			));
//	}
}
