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
use OC\WebAgencyBundle\Entity\Comment;


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

		if ($comments == null) {
			$message = "Pas de commentaire à valider pour le moment";

		}
		else $message = "Vous avez des commentaires à valider";


		return $this->render('OCWebAgencyBundle:Admin:admin.html.twig', array(
			'comments' => $comments,
			'posts'    => $posts,
			'message' => $message
		));
	}

	/**
	 * Deletes a comment entity.
	 * @param Comment $comment
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteCommentAction(/*Request $request, */Comment $comment)
	{
		//$form = $this->createDeleteForm($comment);
		//$form->handleRequest($request);

		//if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($comment);
			$em->flush();
		//}

		return $this->redirectToRoute('oc_web_agency_admin');
	}

}