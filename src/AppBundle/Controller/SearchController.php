<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route(path="busca/categoria/{slug}", name="search-by-category", methods={"GET"})
     *
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchByCategoryAction(Category $category)
    {
        return $this->render('search/search-by-category.html.twig', [
            'products' => $category->getProducts(),
            'category' => $category
        ]);
    }
}
