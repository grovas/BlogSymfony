<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LoginPersonController extends Controller
{
    public function indexAction(Request $request)
    {
		$user = new Person();
    	$em = $this->getDoctrine()->getManager();

		$form = $this->createFormBuilder($user)
			->add('name', TextType::class)
			->add('password', PasswordType::class)
			->add('zaloguj',
				SubmitType::class, array('label' => 'Zaloguj się'))
			->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$user = $form->getData();
			$em->persist($user);
			$em->flush();

			return $this->redirectToRoute('user_success');
		}

        return $this->render('login/login_form.html.twig',
			array('form' =>$form->createView(),
		));
    }

	public function loginAcion ($password, $name)
	{
		$repository = $this->getDoctrine()
			->getRepository('AppBundle:Person');

		$person = $repository
			-> findOneByName(array('name' => $name));

		if (!$person) {
			throw $this->createNotFoundException(
				'Nie ma takiego użytkownika '.$name
			);
		}
	}
}
