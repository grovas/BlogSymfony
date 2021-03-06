<?php

namespace AppBundle\Controller\PostController;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ViewPostController extends Controller
{
    public function indexAction($id)
    {
    	$post = $this->getDoctrine()
			->getRepository(Post::class)
			->find($id);

    	if (!$post) {
			throw $this->createNotFoundException(
				'Nie zanlezione posta o podanym id='.$id
			);
		}
        return $this->render('post/view_post.html.twig', array('post' => $post));
    }
}
