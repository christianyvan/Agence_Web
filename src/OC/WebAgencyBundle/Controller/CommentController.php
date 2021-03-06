<?php

namespace OC\WebAgencyBundle\Controller;

use OC\WebAgencyBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Comment controller.
 *
 */
class CommentController extends Controller
{

	/**
	 * Lists all comment entities.
	 *
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$comments = $em->getRepository('OCWebAgencyBundle:Comment')->findAll();

		return $this->render('comment/index.html.twig', array(
			'comments' => $comments,
		));
	}

	/**
	 * Creates a new comment entity.
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function newAction(Request $request)
	{
		$comment = new Comment();
		$form = $this->createForm('OC\WebAgencyBundle\Form\CommentType', $comment);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($comment);
			$em->flush();

			return $this->redirectToRoute('admin_comment_show', array('id' => $comment->getId()));
		}

		return $this->render('comment/new.html.twig', array(
			'comment' => $comment,
			'form' => $form->createView(),
		));
	}

	/**
	 * @param Comment $comment
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function showAction(Comment $comment)
	{
		$deleteForm = $this->createDeleteForm($comment);

		return $this->render('comment/show.html.twig', array(
			'comment' => $comment,
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * @param Request $request
	 * @param Comment $comment
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function editAction(Request $request, Comment $comment)
	{
		$deleteForm = $this->createDeleteForm($comment);
		$editForm = $this->createForm('OC\WebAgencyBundle\Form\CommentType', $comment);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('admin_comment_edit', array('id' => $comment->getId()));
		}

		return $this->render('comment/edit.html.twig', array(
			'comment' => $comment,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * @param Request $request
	 * @param Comment $comment
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, Comment $comment)
	{
		$form = $this->createDeleteForm($comment);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($comment);
			$em->flush();
		}

		return $this->redirectToRoute('admin_comment_index');
	}

	/**
	 * Creates a form to delete a comment entity.
	 *
	 * @param Comment $comment The comment entity
	 *
	 * @return \Symfony\Component\Form\FormInterface
	 */
	private function createDeleteForm(Comment $comment)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('admin_comment_delete', array('id' => $comment->getId())))
			->setMethod('DELETE')
			->getForm()
			;
	}
}
