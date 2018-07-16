<?php

namespace OC\WebAgencyBundle\Controller;

use Doctrine\ORM\Mapping as ORM;
use OC\WebAgencyBundle\Entity\Post;
use OC\WebAgencyBundle\Entity\Comment;
use OC\WebAgencyBundle\Form\CommentType;
use OC\WebAgencyBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Post controller.
 *
 * @ORM\Entity
 * @ORM\Table(name="post_controller")
 */
class PostController extends Controller
{

	/**
	 * Lists all post entities.
	 *
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$posts = $em->getRepository('OCWebAgencyBundle:Post')->findAll();

		return $this->render('post/index.html.twig', array(
			'posts' => $posts,
		));
	}

	/**
	 * Creates a new post entity.
	 *
	 */
	public function newAction(Request $request)
	{
		$post = new Post();
		$form = $this->createForm('OC\WebAgencyBundle\Form\PostType', $post);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($post);
			$em->flush();

			return $this->redirectToRoute('admin_post_show', array('id' => $post->getId()));
		}

		return $this->render('post/new.html.twig', array(
			'post' => $post,
			'form' => $form->createView(),
		));
	}

	/**
	 * Finds and displays a post entity.
	 *
	 */
	public function showAction(Post $post)
	{
		$deleteForm = $this->createDeleteForm($post);

		return $this->render('post/show.html.twig', array(
			'post' => $post,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Displays a form to edit an existing post entity.
	 * @param Request $request
	 * @param Post $post
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function editAction(Request $request, Post $post)
	{
		$deleteForm = $this->createDeleteForm($post);
		$editForm = $this->createForm('OC\WebAgencyBundle\Form\PostType', $post);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('admin_post_edit', array('id' => $post->getId()));
		}

		return $this->render('post/edit.html.twig', array(
			'post' => $post,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a post entity.
	 *
	 */
	public function deleteAction(Request $request, Post $post)
	{
		$form = $this->createDeleteForm($post);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($post);
			$em->flush();
		}

		return $this->redirectToRoute('admin_post_index');
	}

	/**
	 * Creates a form to delete a post entity.
	 *
	 * @param Post $post The post entity
	 *
	 * @return \Symfony\Component\Form\FormInterface
	 */
	private function createDeleteForm(Post $post)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('admin_post_delete', array('id' => $post->getId())))
			->setMethod('DELETE')
			->getForm()
			;
	}


	public function postAction(Request $request,$id)
	{
		$em = $this->getDoctrine()->getManager();

		$post = $em->getRepository('OCWebAgencyBundle:Post')->find($id);

		$comments = $em->getRepository('OCWebAgencyBundle:Comment')->findBy(array('postId'=>$id,'isSeen' => 1));

		$comment = new  Comment;
		//$postId = $post->getId();
		//$comment->setPostId($postId);
		// on récupère le formulaire associé à l'entité PurchaseOrder dans la variable $form
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


				// Redirection vers la page de description de la commande
				return $this->redirectToRoute('oc_web_agency_completepost',array(
					'post' => $post,
					'comments' => $comments
				));
			}
		}

		return $this->render('@OCWebAgency/Blog/completeArticleFrontEnd.html.twig', array(
			'form' => $form->createView(),
			'post' => $post,
			'comments' => $comments
		));

	}

	public function addCommentPostAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$post = $em->getRepository('OCWebAgencyBundle:Post')->find($_POST['submit']);
		$comment = new  Comment;

		// on récupère le formulaire associé à l'entité comment dans la variable $form
		//$form = $this->createForm(CommentType::class,$comment);


		//if ($request->isMethod('POST'))
		//{
			// on hydrate l'entité Comment avec les donnée transmise via la méthode POST
			// $comment contient maintenant les données du formulaire
			//$form->handleRequest($request);
			$comment->setPostId($_POST['submit']);
			$comment->setAuthor($_POST['author']);
			$comment->setContent($_POST['comment']);
			$comment->setEmail($_POST['email']);
			$comment->setPosts($post);


			//if ($form->isSubmitted() && $form->isValid())
			//{
				$em->persist($comment);
				$em->flush();
				//die('cooucou');

				// Redirection vers la page de description de la commande
				return $this->redirectToRoute('oc_web_agency_blog');
		//	}
		//}

	//	return $this->redirectToRoute('oc_web_agency_blog');
	}
}
