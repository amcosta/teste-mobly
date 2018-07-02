<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sale;
use AppBundle\Entity\SaleItem;
use AppBundle\Form\SaleType;
use AppBundle\Services\Cart\CartItem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CheckoutController extends Controller
{
    /**
     * @Route(path="checkout", name="checkout-index", methods={"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $cart = $this->get('app.cart.helper')->getCart();
        $user = $this->getUser();

        $sale = new Sale();

        $items = array_map(function (CartItem $cartItem) use ($sale) {
            $saleItem = new SaleItem();

            $saleItem->setSale($sale);
            $saleItem->setQuantity($cartItem->getQuantity());
            $saleItem->setPrice($cartItem->getProductPrice());
            $saleItem->setName($cartItem->getProductName());

            return $saleItem;
        }, $cart->getItems());

        $sale->setCustomer($user);
        $sale->setItems($items);
        $sale->setShipping(0);

        $form = $this->createForm(SaleType::class, $sale, ['method' => 'post', 'action' => $this->generateUrl('checkout-index')]);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('checkout/index.html.twig', [
                'addresses' => $user->getAddresses(),
                'sale' => $sale,
                'form' => $form->createView()
            ]);
        }

        $this->getDoctrine()->getManager()->persist($sale);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('congratulation', ['id' => $sale->getId()]);
    }

    /**
     * @Route(path="checkout/pedido-finalizado/{id}", name="congratulation", methods={"GET"}, requirements={"id": "\d+"})
     *
     * @param Sale $sale
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function congratulationAction(Sale $sale)
    {
        return $this->render('checkout/congratulation.html.twig', [
            'sale' => $sale
        ]);
    }
}
