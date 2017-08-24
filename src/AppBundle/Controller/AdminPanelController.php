<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminPanelController extends Controller
{
    public function indexAction($id)
    {
		$this->denyAccessUnlessGranted(
			'ROLE_ADMIN', null,
			'Nie masz dostępu do tej strony!');

		$em=$this->getDoctrine()
			->getRepository(User::class)
			->find($id);

		if(!$em){
			throw $this->createNotFoundException(
				'Nie znaleziono użytkownika o id: '.$id
			);
		}

        return $this->render('admin/userview.html.twig',
			array('u' => $em));
    }

    public function viewAction ()
	{
		$this->denyAccessUnlessGranted(
			'ROLE_ADMIN', null,
			'Nie masz dostępu do tej strony!');

		$em=$this->getDoctrine()
			->getRepository(User::class)
			->findAll();

		return $this->render('/admin/panel.html.twig',
			array('users' => $em));
	}
}
