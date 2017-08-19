<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class NewPostController extends Controller
{
    public function indexAction(Request $request)
    {
    	$post = new Post();
		// TODO: usunac ta formatke - nowa jest PostType class
		$form = $this->createFormBuilder($post)
			->add('title', TextType::class)
			->add('body', TextType::class)
			->add('date', DateTime::class)
			->add('dodaj',
				SubmitType::class, array('label' => 'Dodaj post'))
			->getForm();

		$form->handleRequest($request);
		$post = $form->getData();

        return $this->render('post/new_post.html.twig',
			array('form' => $form->createView()));
    }
}
