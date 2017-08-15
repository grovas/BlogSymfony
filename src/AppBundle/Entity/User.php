<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, \Serializable
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $username;

	/**
	 * @var string
	 */
	private $password;

	/**
	 * @var string
	 */
	private $email;

	/**
	 * @var string
	 */
	private $phone;

	/**
	 * @var boolean
	 */
	private $isActive;

	/**
	 * @var string
	 */
	private $roles;

	/**
	 * @var string
	 */
	private $token;

	/**
	 * @var int
	 */
	private $tstamp;

	/**
	 * User constructor.
	 */

	public function __construct()
	{
		$this->isActive = false;
	}

	public function serialize()
	{
		return serialize(array(
			$this->id,
			$this->username,
			$this->password,
		));
	}

	public function unserialize($serialized)
	{
		list (
			$this->id,
			$this->username,
			$this->password,
			) = unserialize($serialized);
	}

	public function getRoles()
	{
		//return array('ROLE_USER');
		return explode(',', $this->roles);
	}

	public function setRoles(string $roles)
	{
		$this->roles = $roles;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getSalt()
	{
		return null;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function eraseCredentials()
	{
		// TODO: Implement eraseCredentials() method.
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId(int $id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail(string $email)
	{
		$this->email = $email;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->isActive;
	}

	/**
	 * @param bool $isActive
	 */
	public function setIsActive(bool $isActive)
	{
		$this->isActive = $isActive;
	}

	/**
	 * @param string $username
	 */
	public function setUsername(string $username)
	{
		$this->username = $username;
	}

	/**
	 * @param string $password
	 */
	public function setPassword(string $password)
	{
		$this->password = $password;
	}

	/**
	 * @return string
	 */
	public function getToken()
	{
		return $this->token;
	}

	/**
	 * @param string $token
	 */
	public function setToken(string $token)
	{
		$this->token = $token;
	}

	/**
	 * @return int
	 */
	public function getTstamp(): int
	{
		return $this->tstamp;
	}

	/**
	 * @param int $tstamp
	 */
	public function setTstamp(int $tstamp)
	{
		$this->tstamp = $tstamp;
	}

	/**
	 * @return string
	 */
	public function getPhone()
	{
		return $this->phone;
	}

	/**
	 * @param string $phone
	 */
	public function setPhone(string $phone)
	{
		$this->phone = $phone;
	}
}