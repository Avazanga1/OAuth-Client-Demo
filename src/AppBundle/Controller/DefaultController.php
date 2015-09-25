<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction(Request $request)
    {
		$session = $request->getSession();

		var_dump($this->getUser());
		var_dump($session->all());
        return $this->render('default/index.html.twig');
    }

	/**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {

    }
}
