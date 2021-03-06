<?php

namespace OC\WebAgencyBundle\Controller;

use Doctrine\ORM\Mapping as ORM;
use OC\WebAgencyBundle\Entity\Post;
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
        // Ajout Abdel : On obtient toutes les pages pour le menu
        $em = $this->getDoctrine()->getManager();
        $pagesMenu = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->findAll();

	    $em = $this->getDoctrine()->getManager();

		$posts = $em->getRepository('OCWebAgencyBundle:Post')->findAll();


		return $this->render('post/index.html.twig', array(
			'posts' => $posts,
            // Ajout Abdel : Pages pour le menu
            'pagesMenu' => $pagesMenu
		));
	}

	/**
	 * Creates a new post entity.
	 *
	 */
	public function newAction(Request $request)
	{
        // Ajout Abdel : On obtient toutes les pages pour le menu
        $em = $this->getDoctrine()->getManager();
        $pagesMenu = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->findAll();

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
            'pagesMenu' => $pagesMenu
		));
	}

	/**
	 * Finds and displays a post entity.
	 *
	 */
	public function showAction(Post $post)
	{
        // Ajout Abdel : On obtient toutes les pages pour le menu
        $em = $this->getDoctrine()->getManager();
        $pagesMenu = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->findAll();

	    $deleteForm = $this->createDeleteForm($post);

		return $this->render('post/show.html.twig', array(
			'post' => $post,
			'delete_form' => $deleteForm->createView(),
            // Ajout Abddl : Pages pour le menu
            'pagesMenu' => $pagesMenu,
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
        // Ajout Abdel : On obtient toutes les pages pour le menu
        $em = $this->getDoctrine()->getManager();
        $pagesMenu = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->findAll();
	    $deleteForm = $this->createDeleteForm($post);
		$editForm = $this->createForm('OC\WebAgencyBundle\Form\PostType', $post);
		//dump($post);
		//exit;
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('admin_post_edit', array('id' => $post->getId()));
		}

		return $this->render('post/edit.html.twig', array(
			'post' => $post,
			'edit_form' => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
			// Ajout Abdel
            'pagesMenu' => $pagesMenu
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
	
	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function searchBarAction(Request $request){

		if(isset($_GET["q"]))
		{
            // Ajout Abdel : On obtient toutes les pages pour le menu
            $em = $this->getDoctrine()->getManager();
            $pagesMenu = $em
                ->getRepository('OCWebAgencyBundle:Page')
                ->findAll();

		    $word=$_GET["q"];
		    // Abdel : recherche par catérorie de post
		    $category= $_GET['c'];

				$em=$this->getDoctrine()->getManager();
				// Abdel : on récupère le array des résultats et on ajoute la pagination
                $query=$em->getRepository(Post::class)->findLikeWord($word,$category);

                $posts = $this->get('knp_paginator')->paginate(
                    $query,
                    $request->query->getInt('page', 1),
                    4
                );

				if(!empty($query)){
				    $request->getSession()->getFlashBag()->add('avert-message', 'Voici les résultats de votre recherche');
					return $this->render('OCWebAgencyBundle:Blog:index.html.twig',array(
						'posts'=>$posts,
                        'pagesMenu' => $pagesMenu,
                        'page' => $request->query->getInt('page', 1)
					));
				}
				else
				{
				    //$message = "Pas de résultat pour votre recherche";
                    $request->getSession()->getFlashBag()->add('avert-message', 'Pas de résultat pour votre recherche');
					return $this->render('OCWebAgencyBundle:Blog:index.html.twig',array(
                        'posts'=>$posts,
					    'search'=>null,
                        'pagesMenu' => $pagesMenu,
                        'page' => $request->query->getInt('page', 1)

					));
				}

		}

		else {

			return $this->redirectToRoute('oc_web_agency_search');

		}
}




	public function handleSearchAction(Request $request){


	}

}
