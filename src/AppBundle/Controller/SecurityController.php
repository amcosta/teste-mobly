<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use AppBundle\Form\CustomerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class SecurityController extends Controller
{
    /**
     * @Route(path="login", name="login", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $customer = new Customer();
        $customerForm = $this->createForm(CustomerType::class, $customer, [
            'method' => 'post',
            'action' => $this->generateUrl('login')
        ]);

        $customerForm->handleRequest($request);

        if (!$customerForm->isSubmitted() || !$customerForm->isValid()) {
            return $this->render('login/index.html.twig', [
                'last_username' => $lastUsername,
                'error' => $error,
                'form' => $customerForm->createView()
            ]);
        }

        $customer->enable();
        $customer->updateUsername();

        $this->get('fos_user.user_manager')->updateUser($customer);

        $this->getDoctrine()->getManager()->persist($customer);
        $this->getDoctrine()->getManager()->flush();

        $token = new UsernamePasswordToken($customer->getEmail(), $customer->getPassword(), 'main', $customer->getRoles());
        $this->get('security.token_storage')->setToken($token);

        $this->get('session')->set('_security_main', serialize($token));

        $event = new InteractiveLoginEvent($request, $token);
        $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

        return $this->redirectToRoute('customer-new-address');
    }

    /**
     * @Route(path="logout", name="logout", methods={"GET", "POST"})
     */
    public function logoutAction()
    {

    }

    /**
     * @Route(path="check-login", name="check-login", methods={"POST"})
     */
    public function checkLoginAction()
    {

    }
}
