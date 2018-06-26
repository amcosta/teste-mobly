<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HeaderController extends Controller
{
    public function indexAction()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('header.html.twig', [
            'categories' => $categories
        ]);
    }
}
