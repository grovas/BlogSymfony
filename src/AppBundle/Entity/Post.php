<?php

namespace AppBundle\Entity;

use DateTime;

class Post
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var datetime
	 */
	private $date;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $body;

	/**
	 * @var string
	 */
	private $attachment;

	/**
	 * @var string
	 */
	private $attaOriginName;

	/**
	 * @var User
	 */
	private $user;

	public function __construct()
	{
		$this->setDate(new \DateTime());
	}

	/**
	 * @return mixed
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @param mixed $user
	 */
	public function setUser($user)
	{
		$this->user = $user;
	}

	/**
	 * @param int $id
	 */
	public function setId(int $id)
	{
		$this->id = $id;
	}

	/**
	 * @return datetime
	 */
	public function getDate(): \Datetime
	{
		return $this->date;
	}

	/**
	 * @param datetime $date
	 */
	public function setDate(\DateTime $date)
	{
		$this->date = $date;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return $this
	 */
	public function setTitle(string $title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getText(): string
	{
		return $this->body;
	}

	/**
	 * @param string $body
	 */
	public function setText(string $body)
	{
		$this->body = $body;
	}

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

	/**
	 * @return string
	 */
	public function getAttachment()
	{
		return $this->attachment;
	}

	/**
	 * @param string $attachment
	 * @return $this
	 */
	public function setAttachment(string $attachment)
	{
		$this->attachment = $attachment;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAttaOriginName()
	{
		return $this->attaOriginName;
	}

	/**
	 * @param string $attaOriginName
	 * @return $this
	 */
	public function setAttaOriginName(string $attaOriginName)
	{
		$this->attaOriginName = $attaOriginName;
		return $this;
	}


	public function __toString()
	{
		return $this->getId() ? (string)$this->getTitle() : '-';
	}

	public function __call($name, $arguments)
	{
		// TODO: Implement __call() method.
	}


}
