<?php

namespace AppBundle\Controller\PostController;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditPostController extends Controller
{
    public function indexAction($id)
    {
        return $this->render('post/edit_post.html.twig', array('name' => $id));
    }
}
