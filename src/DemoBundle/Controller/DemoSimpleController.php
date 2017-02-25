<?php

namespace DemoBundle\Controller;

use DemoBundle\Forms\DemoPasswordsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DemoSimpleController extends Controller
{
    /**
     * @Route("/", name="demoPassword")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $form = $this->createPasswordForm();

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/check_password", name="demoCheckPassword")
     * @Method("POST")
     */
    public function checkPasswordAction(Request $request)
    {
        $password = $request->get('password');
        $passManager = $this->get('pass_security.manager');
        $number = $passManager->getNumberOrNull($password);

        return new JsonResponse(['number' => $number]);
    }

    /**
     * @return \Symfony\Component\Form\Form
     */
    private function createPasswordForm()
    {
        $form = $this->createForm(
            DemoPasswordsType::class,
            null,
            [
                'action' => $this->generateUrl('demoCheckPassword'),
                'method' => 'POST',
            ]
        );

        return $form;
    }
}
