<?php

namespace AppBundle\Controller\PostController;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class NewPostController - create: new post entity and form to add post
 */
class NewPostController extends Controller
{
	/**
	 * Function create: Post object, form and persist new Post to database
	 *
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
    public function indexAction(Request $request)
    {
    	/** @var Post $post */
    	$post = new Post();
    	/** @var Form $form */
    	$form = $this->createForm(PostType::class, $post);
		$form->handleRequest($request);

		/** Check if form is submitted and valid */
		if ($form->isSubmitted() && $form->isValid()) {
			/** recieve data from the form */
			$post = $form->getData();
			/**
			 * Attachment is not required, if not pass by user
			 * we don't persist them to the DB
			 */
			if ($post->getAttachment()) {
				/** @var UploadedFile $file */
				$file = $post->getAttachment();
				/** Store original file name on the property AttaOrigName */
				$post->setAttaOriginName($file->getClientOriginalName());
				/** Rename file name using md5 algorithm */
				$filename = md5(uniqid()) . '.' . $file->guessExtension();
				/**
				 * Move file to the directory set by @const attachment_directory
				 * in the config.yml:parameters section
				 */
				$file->move(
					$this->getParameter('attachment_directory'),
					$filename
				);
				$post->setAttachment($filename);
			}
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
