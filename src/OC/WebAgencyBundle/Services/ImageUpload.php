<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 17/07/2018
 * Time: 17:31
 */

namespace OC\WebAgencyBundle\Services;
//use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUpload
{
	private $targetDir;

	public function __construct($targetDir)
	{
		$this->targetDir=$targetDir;
	}


	public function upload(UploadedFile $file)
	{
		$fileName=md5(uniqid()) . '.' . $file->guessExtension();

		$file->move($this->getTargetDir(),$fileName);

		return $fileName;
	}
	public function getTargetDir()
	{
		return $this->targetDir;
	}
}
