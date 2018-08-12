<?php

namespace OC\WebAgencyBundle\Controller;

use OC\WebAgencyBundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{
    /**
     * Lists all page entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pages = $em->getRepository('OCWebAgencyBundle:Page')->findAll();

        return $this->render('page/index.html.twig', array(
            'pages' => $pages,
        ));
    }

    /**
     * Creates a new page entity.
     *
     */
    public function newAction(Request $request)
    {
        $page = new Page();
        $form = $this->createForm('OC\WebAgencyBundle\Form\PageType', $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('admin_page_show', array('id' => $page->getId()));
        }

        return $this->render('page/new.html.twig', array(
            'page' => $page,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a page entity.
     *
     */
    public function showPageAction($slug)
    {

        $em = $this->getDoctrine()->getManager();

        // on obtient les infos de la page
        $page = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->getPage($slug)
        ;

        if (null === $page) {
            throw new NotFoundHttpException("La page ".$slug." n'existe pas.");
        }

        // On obtient des items de la page
        $listItems = $em
            ->getRepository('OCWebAgencyBundle:Item')
            ->findBy(array('page' => $page))
        ;

        // On teste la variable $slug et on reroute vers des twig différents
        if (stripos($slug, 'agence') !== FALSE) {

            // on récupère les infos des items
            $itemsInfos = $em
                ->getRepository('OCWebAgencyBundle:item')
                ->itemInfos($listItems);

            return $this->render('OCWebAgencyBundle:Pages:agence.html.twig', array(
                'page' => $page,
                'listItems' => $listItems,
                'itemsInfos'=> $itemsInfos,
            ));
        }

        if (stripos($slug, 'service') !== FALSE)
        {
            // on récupère les infos des items
            $itemsInfos = $em
                ->getRepository('OCWebAgencyBundle:item')
                ->itemInfos($listItems);

            return $this->render('OCWebAgencyBundle:Pages:services.html.twig', array(
                'page' => $page,
                'listItems' => $listItems,
                'itemsInfos'=> $itemsInfos,
            ));
        }

        if (stripos($slug, 'references') !== FALSE)
        {
            // on récupère les infos des items
            $itemsInfos = $em
                ->getRepository('OCWebAgencyBundle:item')
                ->itemInfos($listItems);
            //dump($listItems);
            //exit;

            return $this->render('OCWebAgencyBundle:Pages:references.html.twig', array(
                'page' => $page,
                'listItems' => $listItems,
                'itemsInfos'=> $itemsInfos,
            ));
        }

    }

    /**
     * Finds and displays a page entity.
     *
     */
    public function showAdminAction(Page $page)
    {
        $deleteForm = $this->createDeleteForm($page);

        $em = $this->getDoctrine()->getManager();

        // On obtient la page passer en parametre
        $page = $em->getRepository('OCWebAgencyBundle:Page')->find($page);

        // On obtient toutes les pages pour le menu
        $pagesMenu = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->findAll();

        // On obtient des items de la page
        $listItems = $em
            ->getRepository('OCWebAgencyBundle:Item')
            ->findBy(array('page' => $page))
        ;


        return $this->render('page/show.html.twig', array(
            'page' => $page,
            'pagesMenu' => $pagesMenu,
            'listeItems' => $listItems,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing page entity.
     *
     */
    public function editAction(Request $request, Page $page)
    {
        // On obtient toutes les pages pour le menu
        $em = $this->getDoctrine()->getManager();
        $pagesMenu = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->findAll();

        $deleteForm = $this->createDeleteForm($page);
        $editForm = $this->createForm('OC\WebAgencyBundle\Form\PageType', $page);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_page_edit', array('id' => $page->getId()));
        }

        return $this->render('page/edit.html.twig', array(
            'page' => $page,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagesMenu' => $pagesMenu
        ));
    }

    /**
     * Deletes a page entity.
     *
     */
    public function deleteAction(Request $request, Page $page)
    {
        $form = $this->createDeleteForm($page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush();
        }

        return $this->redirectToRoute('admin_page_index');
    }

    /**
     * Creates a form to delete a page entity.
     *
     * @param Page $page The page entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Page $page)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_page_delete', array('id' => $page->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function menuFrontAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pagesMenu = $em->getRepository('OCWebAgencyBundle:Page')->findAll();

        return $this->render('OCWebAgencyBundle:Navigation:frontEnd.html.twig', [
            'pagesMenu' => $pagesMenu
        ]);
    }

    public function menuBackAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pagesMenu = $em->getRepository('OCWebAgencyBundle:Page')->findAll();

        return $this->render('OCWebAgencyBundle:Navigation:backEnd.html.twig', [
            'pagesMenu' => $pagesMenu
        ]);
    }

    public function pageAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $pagesMenu = $em->getRepository('OCWebAgencyBundle:Page')-findAll();



        return $this->render('home/index.html.twig', [
            'pagesMenu' => $pagesMenu

        ]);
    }
}
