<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Form\AddressType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddressController extends Controller
{
    /**
     * @Route(path="minha-conta/novo-endereco", name="customer-new-address", methods={"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAddressAction(Request $request)
    {
        $address = new Address();

        $form = $this->createForm(AddressType::class, $address, [
            'method' => 'post',
            'action' => $this->generateUrl('customer-new-address')
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || $form->isValid()) {
            return $this->render('customer/address.html.twig', ['form' => $form->createView()]);
        }

        $customer = $this->getUser();
        $address->setCustomer($customer);

        $this->getDoctrine()->getManager()->persist($address);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('home');
    }
}
