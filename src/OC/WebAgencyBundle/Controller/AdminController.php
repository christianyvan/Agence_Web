<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 05/07/2018
 * Time: 22:46
 */

namespace OC\WebAgencyBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class AdminController
 * @package OC\WebAgencyBundle\Controller
 */
class AdminController extends Controller
{
	public function adminAction(){


		$comments = $this->getDoctrine()
			->getManager()
			->getRepository('OCWebAgencyBundle:Comment')
			->findAll();

		$posts = $this->getDoctrine()
			->getManager()
			->getRepository('OCWebAgencyBundle:Post')
			->findAll();

		// si aucun commentaire associé au post  on lève une exception
		if ($posts === null) {
			throw new NotFoundHttpException("Pas de posts ");
		}


		return $this->render('OCWebAgencyBundle:Admin:admin.html.twig', array(
			'comments' => $comments,
			'posts'    => $posts
		));
	}

}