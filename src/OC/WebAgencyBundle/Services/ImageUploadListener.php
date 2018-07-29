<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 18/07/2018
 * Time: 08:08
 */

namespace OC\WebAgencyBundle\Services;
use OC\WebAgencyBundle\Entity\Post;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
//use OC\WebAgencyBundle\Services\ImageUpload;

class ImageUploadListener
{
	private $uploader;

	public function __construct(ImageUpload $uploader)
	{
		$this->uploader = $uploader;
	}

	public function prePersist(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();

		$this->uploadFile($entity);
	}

	public function preUpdate(PreUpdateEventArgs $args)
	{
		$entity = $args->getEntity();

		$this->uploadFile($entity);
	}

	private function uploadFile($entity)
	{
		// upload only works for Product entities
		if (!$entity instanceof Post) {
			return;
		}

		$file = $entity->getImage();

		// only upload new files
		if (!$file instanceof UploadedFile) {
			return;
		}

		$fileName = $this->uploader->upload($file);
		$entity->setImage($fileName);
	}
}