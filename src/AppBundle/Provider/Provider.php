<?php
/**
 * Created by PhpStorm.
 * User: Karol
 * Date: 2015-04-16
 * Time: 11:43
 */

namespace AppBundle\Provider;


use AppBundle\Model\OAuthUser;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider;

class Provider extends OAuthUserProvider
{
	protected $session, $doctrine, $admins;
	public function __construct($session, $doctrine, $admins = array()) {
		$this->session = $session;
		$this->doctrine = $doctrine;
		$this->admins = $admins;
	}

	public function loadUserByUsername($username)
	{
		return new OAuthUser($username, $this->isUserAdmin($username)); //look at the class below
	}

	private function isUserAdmin($nickname)
	{
		return false;
		// todo: do it.
		//return in_array($nickname, $this->admins);
	}

	public function loadUserByOAuthUserResponse(UserResponseInterface $response)
	{
		//data from facebook response
//		dump($response->getAccessToken(), $response->getRefreshToken());
//		die();
		$id = $response->getUsername();
		$nickname = $response->getNickname();
		$email    = $response->getEmail();

		//set data in session
		$this->session->set('id', $id);
		$this->session->set('email', $email);
		$this->session->set('access_token', $response->getAccessToken());
		$this->session->set('refresh_token', $response->getRefreshToken());
/*
		//get user by fid
		$qb = $this->doctrine->getManager()->createQueryBuilder();
		$qb ->select('u.id')
			->from('AcmeDemoBundle:User', 'u')
			->where('u.fid = :fid')
			->setParameter('fid', $facebook_id)
			->setMaxResults(1);
		$result = $qb->getQuery()->getResult();

		//add to database if doesn't exists
		if ( !count($result) ) {
			$User = new User();
			$User->setCreatedAt(new \DateTime());
			$User->setNickname($nickname);
			$User->setRealname($realname);
			$User->setEmail($email);
			$User->setAvatar($avatar);
			$User->setFID($facebook_id);

			$em = $this->doctrine->getManager();
			$em->persist($User);
			$id = $em->flush();
		} else {
			$id = $result[0]['id'];
		}
		*/

		//@TODO: hmm : is admin
		if ($this->isUserAdmin($nickname)) {
			$this->session->set('is_admin', true);
		}

		//parent:: returned value
		return $this->loadUserByUsername($response->getNickname());
	}

	public function supportsClass($class)
	{
		return $class === 'AppBundle\\Model\\OAuthUser';
	}
}
