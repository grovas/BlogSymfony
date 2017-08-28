<?php

namespace AppBundle\Controller\PostController;

use AppBundle\Entity\Post;
use AppBundle\Form\EditPostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

class EditPostController extends Controller
{
	public function indexAction(Request $request, $id)
	{
		$post = $this->getDoctrine()
			->getRepository(Post::class)
			->find($id);

		if (!$post) {
			throw $this->createNotFoundException(
				'Nie zanlezione posta o podanym id='.$id
			);
		}

		$form = $this->createForm(EditPostType::class, $post);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$post = $form->getData();
			/**
			 * Attachment is not required, if not pass by user
			 * we don't persist them to the DB
			 */
			if ($post->getAttachment()) {
				$file = $post->getAttachment();
				$post->setAttaOriginName($file->getClientOriginalName());
				$filename = md5(uniqid()) . '.' . $file->guessExtension();
				$file->move(
					$this->getParameter('attachment_directory'),
					$filename
				);
				$post->setAttachment($filename);
				$post->setAttachment(
					new File($this->getParameter('attachment_directory')
						. '/' . $post->getAttachment()));
			}
			$post->setDate(new \DateTime());
			$em = $this->getDoctrine()->getManager();
			$em->persist($post);
			$em->flush();
			return $this->redirectToRoute('personal_index');
		}

		return $this->render('post/edit_post.html.twig',
			array('form' => $form->createView()));
	}
}