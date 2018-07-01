<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Entity\Customer;
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


}
