<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Entity\Customer;
use AppBundle\Entity\Sale;
use AppBundle\Form\AddressType;
use AppBundle\Form\CustomerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CustomerController extends Controller
{
    /**
     * @Route(path="cadastre-se", name="customer-register")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $url = $this->generateUrl('customer-register');

        $customer = new Customer();
        $customerForm = $this->createForm(CustomerType::class, $customer, ['method' => 'post', 'action' => $url]);

        $address = new Address();
        $addressForm = $this->createForm(AddressType::class, $address, ['method' => 'post', 'action' => $url]);

        $customerForm->handleRequest($request);
        $addressForm->handleRequest($request);

        if (!$customerForm->isValid() || !$addressForm->isValid()) {
            return $this->render('customer/register.html.twig', [
                'customerForm' => $customerForm->createView(),
                'addressForm' => $addressForm->createView()
            ]);
        }
    }

    /**
     * @Route(path="minha-conta/pedidos", name="customer-purchases", methods={"GET"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function purchasesAction(Request $request)
    {
        $customer = $this->getUser();
        $purchases = $this->getDoctrine()->getRepository(Sale::class)->findBy(['customer' => $customer], ['created' => 'DESC']);

        return $this->render('customer/purchases.html.twig', ['purchases' => $purchases]);
    }

    /**
     * @Route(path="minha-conta/pedido/{id}", name="customer-purchase", methods={"GET"}, requirements={"id": "\d+"})
     *
     * @param Sale $purchase
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function purchaseAction(Sale $purchase)
    {
        return $this->render('customer/purchase.html.twig', ['purchase' => $purchase]);
    }
}
