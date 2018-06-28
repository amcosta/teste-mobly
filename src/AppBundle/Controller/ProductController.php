<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    /**
     * @Route(path="produto/{slug}", name="product-detail", methods={"GET"})
     *
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction(Product $product)
    {
        $similarProducts = $this->getDoctrine()->getRepository(Product::class)->similarProducts($product);

        return $this->render('product/detail.html.twig', [
            'product' => $product,
            'similarProducts' => $similarProducts
        ]);
    }
}
