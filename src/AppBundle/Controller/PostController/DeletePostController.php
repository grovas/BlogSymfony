<?php

namespace AppBundle\Controller\PostController;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeletePostController extends Controller
{
    public function indexAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$post = $em->getRepository(Post::class)
			->find($id);

		if (!$post) {
			throw $this->createNotFoundException(
				'Nie zanlezione posta o id='.$id
			);
		}

		$em->remove($post);
		$em->flush();

        return $this->redirectToRoute('personal_index', array());
    }
}
