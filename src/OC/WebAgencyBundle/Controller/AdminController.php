<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 05/07/2018
 * Time: 22:46
 */

namespace OC\WebAgencyBundle\Controller;
use OC\WebAgencyBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use OC\WebAgencyBundle\Entity\Comment;
use OC\WebAgencyBundle\Entity\User;







/**
 * Gère l'affichage de la pade d'accueil de l'administration du site
 * Class AdminController
 * @package OC\WebAgencyBundle\Controller
 */
class AdminController extends Controller
{
	/**
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function updateIsSeenAction($id)
	{

		$em = $this->getDoctrine()->getManager();
		$comment = $em->getRepository('OCWebAgencyBundle:Comment')->find($id);
		$comment->setIsSeen(1);
		$em->flush();
		return $this->redirectToRoute('oc_web_agency_admin');
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws \Doctrine\ORM\ORMException
	 */
	public function adminAction(){
		$em = $this->getDoctrine()->getManager();
		//$newComment = new CommentRepository($em,);
		//$newPost = new PostRepository($em);
		//$newUser = new UserRepository($em);
		$comments = $this->getDoctrine()
			->getManager()
			->getRepository('OCWebAgencyBundle:Comment')
			->findBy(array('isSeen' => 0));

		$posts = $em
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

		foreach ($comments as $comment){
			 $content = nl2br(htmlspecialchars_decode($comment->getContent()));
			 $comment->setContent($content);
			 substr($comment->getContent(),0,200);
		}


		$nbAdmins = $em->getRepository(User::class)
						->numberAdmins();

		$nbComments = $em  ->getRepository(Comment::class)
						   ->numberComments();
		$nbPosts = $em	->getRepository(Post::class)
			            ->numberPosts();

		return $this->render('OCWebAgencyBundle:Admin:admin.html.twig', array(
			'comments' => $comments,
			'posts'    => $posts,
			'message' => $message,
			'nbAdmins' => $nbAdmins,
			'nbComments' => $nbComments,
			'nbPosts' => $nbPosts
		));
	}

	/**
	 * Deletes a comment entity.
	 * @param Comment $comment
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteCommentAction(Comment $comment)
	{
			$em = $this->getDoctrine()->getManager();
			$em->remove($comment);
			$em->flush();
		
		return $this->redirectToRoute('oc_web_agency_admin');
	}

}