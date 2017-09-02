<?php

namespace AppBundle\Service;

use AppBundle\Entity\Post;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class HandleAttachment
{
	public function uploadAttachment(Post $post)
	{
		/**
		 * Attachment is not required, if not pass by user
		 * we don't persist them to the DB
		 */
		if ($post->getAttachment()) {
			/**
			 * @var UploadedFile $file
			 */
			$file = $post->getAttachment();
			/** Store original file name on the property AttaOrigName */
			$post->setAttaOriginName($file->getClientOriginalName());
			/** Rename file name using md5 algorithm */
			$filename = md5(uniqid()) . '.' . $file->guessExtension();
			/**
			 * Move file to the directory set by @const attachment_directory
			 * in the config.yml:parameters section
			 */
			$file->move(
				$this->getParameter('attachment_directory'),
				$filename
			);
			/**
			 * Save to entity encrypted filename
			 */
			$post->setAttachment($filename);
			/**
			 * Cast string persisted from DB to UploadFile because it's
			 * expected by edit file form
			 */
			$post->setAttachment(
				new File($this->getParameter('attachment_directory')
					. '/' . $post->getAttachment()));
			/** Return Post object */
			return $post;
		}
	}
}