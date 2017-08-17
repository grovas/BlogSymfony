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

	private $user;

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
	 * @return int
	 */
	public function getPostId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setPostId(int $id)
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
    /**
     * @var \AppBundle\Entity\User
     */
    private $blog_users;


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
     * Set blogUsers
     *
     * @param \AppBundle\Entity\User $blogUsers
     *
     * @return Post
     */
    public function setBlogUsers(\AppBundle\Entity\User $blogUsers = null)
    {
        $this->blog_users = $blogUsers;

        return $this;
    }

    /**
     * Get blogUsers
     *
     * @return \AppBundle\Entity\User
     */
    public function getBlogUsers()
    {
        return $this->blog_users;
    }
}
