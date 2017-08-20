<?php

namespace AppBundle\Controller\PostController;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewPostController extends Controller
{
    public function indexAction(Request $request)
    {
    	$post = new Post();
    	$form = $this->createForm(PostType::class, $post);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$post = $form->getData();
			$file = $post->getAttachment();
			$filename = md5(uniqid()).'.'.$file->guessExtension();
			$file->move(
				$this->getParameter('attachment_directory'),
				$filename
			);
			$post->setAttachment($filename);
			$post->setUser($this->getUser());
			$post->setDate(new \DateTime());
			$em = $this->getDoctrine()->getManager();
			$em->persist($post);
			$em->flush();
			return $this->redirectToRoute('personal_index');
		}
        return $this->render('post/new_post.html.twig',
			array('form' => $form->createView()));
    }
}
