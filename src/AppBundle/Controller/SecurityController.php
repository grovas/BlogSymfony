<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    public function loginAction(Request $request,
								AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

//        $user = new User();
//        $form = $this->createFormBuilder($user)
//			//->add('phone', NumberType::class)
//			->add('username', TextType::class)
//			->add('password', PasswordType::class)
//			->add('zaloguj', SubmitType::class, array('label' => "Zaloguj się"))
//			->getForm();

        return $this->render('security/login.html.twig', array(
        	'last_username' => $lastUsername,
			'error' => $error,
//			'form' => $form->createView(),
		));
    }
    // nie ruszaj tej funkcji
	public function loginCheckAction()
	{
	}
}
