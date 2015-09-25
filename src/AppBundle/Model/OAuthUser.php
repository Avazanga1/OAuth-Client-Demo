<?php
/**
 * Created by PhpStorm.
 * User: Karol
 * Date: 2015-04-16
 * Time: 11:44
 */

namespace AppBundle\Model;

use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUser as HWIOAuthUser;

class OAuthUser extends HWIOAuthUser
{
	private $isAdmin = false;

	private $accessToken;
	private $refreshToken;

	public function __construct($username, $isAdmin = false)
	{
		parent::__construct($username);
		$this->isAdmin = $isAdmin;
		$this->accessToken = 'access';
		$this->refreshToken = 'refresh';
	}

	public function getRoles()
	{
		$roles = array('ROLE_USER', 'ROLE_OAUTH_USER');

		if ($this->isAdmin) {
			array_push($roles, 'ROLE_SUPER_ADMIN');
		}

		return $roles;
	}

	/**
	 * @return mixed
	 */
	public function getAccessToken()
	{
		return $this->accessToken;
	}

	/**
	 * @param mixed $accessToken
	 * @return $this
	 */
	public function setAccessToken($accessToken)
	{
		$this->accessToken = $accessToken;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getRefreshToken()
	{
		return $this->refreshToken;
	}

	/**
	 * @param mixed $refreshToken
	 * @return $this
	 */
	public function setRefreshToken($refreshToken)
	{
		$this->refreshToken = $refreshToken;
		return $this;
	}
}