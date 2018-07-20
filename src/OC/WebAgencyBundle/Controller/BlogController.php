<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 05/07/2018
 * Time: 22:46
 */

namespace OC\WebAgencyBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OC\WebAgencyBundle\Form\CommentType;
use OC\WebAgencyBundle\Entity\Comment;
use OC\WebAgencyBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BlogController
 * @package OC\WebAgencyBundle\Controller
 */
class BlogController extends Controller
{
	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function blogAction(Request $request)
	{

		$em=$this->getDoctrine()->getManager();
		$posts=$em->getRepository('OCWebAgencyBundle:Post')->findAll();

		$paginator  = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$posts, /* query NOT result */
			$request->query->getInt('page', 1)/*page number*/,
			4/*limit per page*/
		);

		return $this->render('OCWebAgencyBundle:Blog:blogFrontEnd.html.twig',array(
			//'posts'=>$posts,
			'pagination' => $pagination

		));
	}

	/**
	 * @param Request $request
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function postAction(Request $request,$id)
	{
		$em = $this->getDoctrine()->getManager();
		$post = $em->getRepository('OCWebAgencyBundle:Post')->find($id);
		$comments = $em->getRepository('OCWebAgencyBundle:Comment')->findBy(array('postId'=>$id,'isSeen' => 1));

		if($comments == null){
			$message = 'Pas de commentaires pour cet article, soyez le premier.';
		}
		else
		{
			$message = 'Liste des commentaires :';
		}


		$comment = new  Comment;

		$form = $this->createForm(CommentType::class,$comment);


		if ($request->isMethod('POST'))
		{
			// on hydrate l'entité Comment avec les donnée transmise via la méthode POST
			// $comment contient maintenant les données du formulaire
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid())
			{
				$post->addComment($comment);
				$em->persist($post);
				$em->persist($comment);
				$em->flush();

				return $this->redirectToRoute('oc_web_agency_completepost',array(
					'post' => $post,
					'comments' => $comments,

				));
			}
		}

		return $this->render('@OCWebAgency/Blog/completeArticleFrontEnd.html.twig', array(
			'form' => $form->createView(),
			'post' => $post,
			'comments' => $comments,
			'message' => $message
		));
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function addCommentPostAction()
	{
		$em = $this->getDoctrine()->getManager();
		$post = $em->getRepository('OCWebAgencyBundle:Post')->find($_POST['submit']);
		$comment = new  Comment;

		$comment->setPostId($_POST['submit']);
		$comment->setAuthor($_POST['author']);
		$comment->setContent($_POST['comment']);
		$comment->setEmail($_POST['email']);
		$comment->setPosts($post);

		$em->persist($comment);
		$em->flush();

		return $this->redirectToRoute('oc_web_agency_blog');
	}
}