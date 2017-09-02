<?php

namespace AppBundle\Controller\PostController;

use AppBundle\Entity\Post;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DeletePostController - the only one class in this file
 */
class DeletePostController extends Controller
{
	/**
	 * Property to handle interface ObjectManager
	 *
	 * @var ObjectManager
	 */
	private $objectManager;

	/**
	 * Constructor required by PHPUnit - not implemented tests yet
	 *
	 * DeletePostController constructor.
	 * @param ObjectManager $objectManager interface
	 */
	public function __construct(ObjectManager $objectManager)
	{
		$this->objectManager = $objectManager;
	}

	/**
	 * The main function - responsible for injection of the Post Repository
	 *
	 * @param $id Post id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
    public function indexAction($id)
    {
		/**
         * Get access to the repository object and query for one Post
		 */
		$em = $this->getDoctrine()->getManager();
		$post = $em->getRepository(Post::class)
			->find($id);
//		Other version of above code
//
//		$post = $this->getDoctrine()
//			->getRepository(Post::class)
//			->find($id);
		/**
		 * Check if given post exist in the DB, if not throw exception
		 */
		if (!$post) {
			throw $this->createNotFoundException(
				'Nie zanlezione posta o id='.$id
			);
		}
		/** Tell Doctrine that we want remove post by given id */
		$em->remove($post);
		/** Execute query */
		$em->flush();

		/**
		 * After delete post return to personal page of bloger
		 */
        return $this->redirectToRoute('personal_index', array());
    }
}
