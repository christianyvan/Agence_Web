<?php

namespace OC\WebAgencyBundle\Controller;

use OC\WebAgencyBundle\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Item controller.
 *
 */
class ItemController extends Controller
{
    /**
     * Lists all item entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $items = $em->getRepository('OCWebAgencyBundle:Item')->findAll();

        // On obtient toutes les pages pour le menu
        $pagesMenu = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->findAll();

        return $this->render('item/index.html.twig', array(
            'items' => $items,
            'pagesMenu' => $pagesMenu,
        ));
    }

    /**
     * Creates a new item entity.
     *
     */
    public function newAction(Request $request)
    {
        $item = new Item();
        $form = $this->createForm('OC\WebAgencyBundle\Form\ItemType', $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($item);
            //exit;
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('admin_item_show', array('id' => $item->getId()));
        }

        return $this->render('item/new.html.twig', array(
            'item' => $item,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a item entity.
     *
     */
    public function showAction(Item $item)
    {
        // On obtient toutes les pages pour le menu

        $em = $this->getDoctrine()->getManager();
        $pages = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->findAll();

        $deleteForm = $this->createDeleteForm($item);

        return $this->render('item/show.html.twig', array(
            'item' => $item,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing item entity.
     *
     */
    public function editAction(Request $request, Item $item)
    {
        // On obtient toutes les pages pour le menu
        $em = $this->getDoctrine()->getManager();
        $pagesMenu = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->findAll();

        $deleteForm = $this->createDeleteForm($item);
        $editForm = $this->createForm('OC\WebAgencyBundle\Form\ItemType', $item);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_item_edit', array('id' => $item->getId()));
        }

        return $this->render('item/edit.html.twig', array(
            'item' => $item,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            // Pages pour le menu
            'pagesMenu' => $pagesMenu
        ));
    }

    /**
     * Deletes a item entity.
     *
     */
    public function deleteAction(Request $request, Item $item)
    {
        $form = $this->createDeleteForm($item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($item);
            $em->flush();
        }

        return $this->redirectToRoute('admin_item_index');
    }

    /**
     * Creates a form to delete a item entity.
     *
     * @param Item $item The item entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Item $item)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_item_delete', array('id' => $item->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
