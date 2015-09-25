<?php
/**
 * Created by PhpStorm.
 * User: Karol
 * Date: 2015-04-17
 * Time: 10:04
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConnectController
 * @package AppBundle\Controller
 * @Route("/login")
 */
class ConnectController extends Controller
{
	/**
	 * @Route("/", name="login")
	 */
	public function loginAction(Request $request)
	{
		return $this->render('Connect/login.html.twig');
	}
}