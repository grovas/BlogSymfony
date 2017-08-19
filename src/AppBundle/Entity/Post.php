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
	public function getDate(): datetime
	{
		return $this->date;
	}

	/**
	 * @param datetime $date
	 */
	public function setDate(datetime $date)
	{
		$this->date = $date;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle(string $title)
	{
		$this->title = $title;
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

//    /**
//     * @var User
//     */
//    private $blog_users;

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
	public function getAttachment(): string
	{
		return $this->attachment;
	}

	/**
	 * @param $attachment
	 * @return $this
	 */
	public function setAttachment($attachment)
	{
		$this->attachment = $attachment;
		return $this;
	}



//    /**
//     * Set blogUsers
//     *
//     * @param User $blogUsers
//     *
//     * @return Post
//     */
//    public function setBlogUsers(User $blogUsers = null)
//    {
//        $this->blog_users = $blogUsers;
//        return $this;
//    }
//
//    /**
//     * Get blogUsers
//     *
//     * @return User
//     */
//    public function getBlogUsers()
//    {
//        return $this->blog_users;
//    }

	public function __toString()
	{
		return $this->getId() ? (string)$this->getTitle() : '-';
	}

	public function __call($name, $arguments)
	{
		// TODO: Implement __call() method.
	}


}