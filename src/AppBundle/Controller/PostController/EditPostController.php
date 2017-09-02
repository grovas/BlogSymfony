<?php

namespace AppBundle\Controller\PostController;

use AppBundle\Entity\Post;
use AppBundle\Form\EditPostType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EditPostController - responsible for handle Doctrine entity manager,
 * create form to edit post.
 */
class EditPostController extends Controller
{
	/**
	 * Function responsible for injection of the Post Repository, create edit post form, persist object to DB
	 *
	 * @param Request $request
	 * @param $id Post id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $id)
	{
		/**
		 * Get access to the repository object and query for one Post
		 */

		/**
		 * @var Post $post
		 */
		$post = $this->getDoctrine()
			->getRepository(Post::class)
			->find($id);
		/**
		 * Check if given post exist in the DB, if not throw exception
		 */
		if (!$post) {
			throw $this->createNotFoundException(
				'Nie zanlezione posta o podanym id='.$id
			);
		}
		/**
		 * Creates form to edit post and handle it
		 */
		$form = $this->createForm(EditPostType::class, $post);
		$form->handleRequest($request);
		/**
		 * Check if form is submitted with the valid data
		 */
		if ($form->isSubmitted() && $form->isValid()) {
			/** receive data from the form */
			$post = $form->getData();
			/**
			 * Attachment is not required, if not pass by user
			 * we don't persist them to the DB
			 */
			if ($post->getAttachment()) {
				/**
				 * @var UploadedFile $file
				 */
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
				/**
				 * Save to entity encrypted filename
				 */
				$post->setAttachment($filename);
				/**
				 * Cast string persisted from DB to UploadFile because it's
				 * expected by edit file form
				 */
				$post->setAttachment(
					new File($this->getParameter('attachment_directory')
						. '/' . $post->getAttachment()));
			}
			/** After edit post change post date to the new date */
			$post->setDate(new \DateTime());
			/** @var ObjectManager $em */
			$em = $this->getDoctrine()->getManager();
			/** Tell Doctrine that we want save post by given id */
			$em->persist($post);
			/** Execute query */
			$em->flush();

			return $this->redirectToRoute('personal_index');
		}

		return $this->render('post/edit_post.html.twig',
			array('form' => $form->createView()));
	}
}