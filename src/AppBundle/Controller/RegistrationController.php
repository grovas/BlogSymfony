<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
	/**
	 * @param Request $request
	 * @param UserPasswordEncoderInterface $passwordEncoder
	 * @param Swift_Mailer $mailer
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * @internal param Swift_Mailer $meiler
	 */
    public function registerAction(Request $request,
								   UserPasswordEncoderInterface $passwordEncoder,
								   \Swift_Mailer $mailer)
    {
		//dump($request);
    	$user = new User();
    	$form = $this->createForm(UserType::class, $user);

    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {

    		$password = $passwordEncoder->encodePassword($user, $user->getPassword());
    		$user->setPassword($password);

			/**
			 * Generowanie tokena do wyslania w mailu aktywujacym
			 */
			$token = sha1(uniqid($user->getUsername(), true));
			$user->setToken($token);
			$user->setTstamp(time()+(7*24*60*60));
			$user->setRoles('ROLE_USER');
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($user);
    		$em->flush();

    		// wyslanie meila aktywujacego z linkiem
			if (isset($_SERVER)) {
				$uri = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."/activate=$token";
			}
			$message = (new \Swift_Message('Prośba o potwierdzenie rejestracji'))
				->setFrom(['blogpost.app@gmail.com' => 'Blog Post'])
				->setTo([$user->getEmail() => 'admin'])
				->setBody(
					'<html>'.
							'	<body>'.
							'		Jak kurwa nie klikniesz w link to wpierdol <br>'.
							'		<a href="'. $uri . '">kliklnij w ten link</a>'.
							'	</body>'.
							'</html>',
					'text/html'
				);

			$mailer->send($message);
    		return $this->redirectToRoute('user_success');
		}

		return $this->render(
			'registration/register.html.twig',
			array('form' => $form->createView())
		);
    }

//    public function activateAction()
//	{
//
//	}
}
