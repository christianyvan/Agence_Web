<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 05/07/2018
 * Time: 22:46
 */

namespace OC\WebAgencyBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OC\WebAgencyBundle\Entity\Post;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use OC\WebAgencyBundle\Entity\Comment;



class BlogController extends Controller
{
	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function blogAction()
	{
		$em=$this->getDoctrine()->getManager();

		$posts=$em->getRepository('OCWebAgencyBundle:Post')->findAll();


		return $this->render('OCWebAgencyBundle:Blog:blogFrontEnd.html.twig',array(
			'posts'=>$posts,
		));
	}
}