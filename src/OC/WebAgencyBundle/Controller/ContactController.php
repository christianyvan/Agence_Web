<?php

namespace OC\WebAgencyBundle\Controller;

use OC\WebAgencyBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OC\WebAgencyBundle\Form\ContactType;
use OC\WebAgencyBundle\Entity\ResponseContact;

/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{
    /**
     * Lists all contact entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // Ajout Abdel : On obtient toutes les pages pour le menu
        $pagesMenu = $em->getRepository('OCWebAgencyBundle:Page')->findAll();

        $query = $em->getRepository('OCWebAgencyBundle:Contact')->findAll();

        // Ajout Abdel
        $contacts = $this->get('knp_paginator')->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );

        // Ajout abdel : nombre de contacts sans réponses
        $TotalConatactNoReplay = $em->getRepository('OCWebAgencyBundle:Contact')->numberContacts();

        return $this->render('contact/index.html.twig', array(
            'contacts' => $contacts,
            // Ajout Abdel
            'pagesMenu' => $pagesMenu,
            'page' => $request->query->getInt('page', 1),
            'TotalConatactNoReplay' => $TotalConatactNoReplay
        ));
    }

	/**
	 * Creates a new contact entity.
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
    public function newAction(Request $request)
    {
        // Ajout Abdel : On obtient toutes les pages pour le menu
        $em = $this->getDoctrine()->getManager();
        $pagesMenu = $em->getRepository('OCWebAgencyBundle:Page')->findAll();

        $contact = new Contact();
        $form = $this->createForm('OC\WebAgencyBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('admin_contact_show', array('id' => $contact->getId()));
        }

        return $this->render('contact/new.html.twig', array(
            'contact' => $contact,
            'form' => $form->createView(),
            'pagesMenu' => $pagesMenu
        ));
    }

	/**
	 * Finds and displays a contact entity.
	 * @param Contact $contact
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function showAction(Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);

        // Ajout Abdel : On obtient toutes les pages pour le menu
        $em = $this->getDoctrine()->getManager();
        $pagesMenu = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->findAll();

        return $this->render('contact/show.html.twig', array(
            'contact' => $contact,
            'delete_form' => $deleteForm->createView(),
            // Ajout Abdel
            'pagesMenu' => $pagesMenu
        ));
    }

	/**
	 * Displays a form to edit an existing contact entity.
	 * @param Request $request
	 * @param Contact $contact
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
    public function editAction(Request $request, Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);
        $editForm = $this->createForm('OC\WebAgencyBundle\Form\ContactType', $contact);
        $editForm->handleRequest($request);

        // Ajout Abdel : On obtient toutes les pages pour le menu
        $em = $this->getDoctrine()->getManager();
        $pagesMenu = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->findAll();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_contact_edit', array('id' => $contact->getId()));
        }

        return $this->render('contact/edit.html.twig', array(
            'contact' => $contact,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagesMenu' => $pagesMenu
        ));
    }

	/**
	 * Deletes a contact entity.
	 * @param Request $request
	 * @param Contact $contact
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
    public function deleteAction(Request $request, Contact $contact)
    {
        $form = $this->createDeleteForm($contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contact);
            $em->flush();
        }

        return $this->redirectToRoute('admin_contact_index');
    }

    /**
     * Creates a form to delete a contact entity.
     *
     * @param Contact $contact The contact entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Contact $contact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_contact_delete', array('id' => $contact->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

	public function createContactAction(Request $request)
	{

		$contact = new Contact();

		$form=$this->createForm(ContactType::class,$contact);


		if  ($request->isMethod('POST'))
		{
			// on hydrate l'entité contacton avec les donnée transmise via la méthode POST
			// $contacton contient maintenant les données du formulaire
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid())
			{
				$em=$this->getDoctrine()->getManager();
				$em->persist($contact);
				$em->flush();
			}

			// Redirection vers la page de description de la commande
			return $this->redirectToRoute('oc_web_agency_sendmail',array(
				'id' => $contact->getId()
			));
		}
		return $this->render('OCWebAgencyBundle:Contacts:contacts.html.twig', array(
			'form' => $form->createView(),
		));
	}

	public function sendMailAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$contact = $em->getRepository('OCWebAgencyBundle:Contact')
					  ->find($id);

	/*	$contactId = $contact->getId();
		$contactResponse = new ResponseContact();
		if($contact != null){
			$contactResponse->setContactId($contactId);
			$em->persist($contactResponse);
			$em->flush();
		}*/

		// Préparation de l'email avec les informations de la commande
		$message = \Swift_Message::newInstance()
			->setSubject('Agence LEON - Bonjour, votre demande à bien été reçu')
			->setFrom(array('christian.yvan@gmail.com' => "Agence Web LEON"))
			->setTo($contact->getEmail())
			->setCharset('utf-8')
			->setContentType('text/html')
			->attach(\Swift_Attachment::fromPath('uploads/images/image_1.jpg')->setDisposition('inline'))
			//->setBody($this->renderView('OCWebAgencyBundle:Contacts:contact.html.twig',array('name' => $name)),'text/html');
			->setBody($this->renderView('OCWebAgencyBundle:Contacts:sendEmail.html.twig', array(
				'contact'   	  =>$contact
			)));

		// Envoi du mail
		$this->get('mailer')
			->send($message);

		return $this->render('OCWebAgencyBundle:Home:index.html.twig');
	}


	/**
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function replyAction($id){
			$em = $this->getDoctrine()->getManager();
			$contact = $em->getRepository('OCWebAgencyBundle:Contact')->find($id);
			//$email = $contact->getEmail();

            // Ajout Abdel
            $pagesMenu = $em
            ->getRepository('OCWebAgencyBundle:Page')
            ->findAll();

         	return $this->render('OCWebAgencyBundle:Contacts:replyContact.html.twig',array(
			    'contact'=>$contact,
                'pagesMenu' => $pagesMenu
            ));
	}

	/**
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function responseMailAction($id)
	{
		$responseContact = new ResponseContact();
		$em = $this->getDoctrine()->getManager();
		$contact =  $em->getRepository('OCWebAgencyBundle:Contact')
					   ->find($id);

		/*$responseContact =  $em->getRepository('OCWebAgencyBundle:ResponseContact')
							   ->findBy(
									array('contactId' => $id)
								);*/

		$responseContact->setContentResponse($_POST['reply']);
		$responseContact->setContactId($id);
		$contact->setResponseStatus(1);

		//if(!empty($_POST['response'])){

			$em->persist($responseContact);
			$em->flush();
		//}

		// Préparation de l'email avec les informations de la commande
		$message = \Swift_Message::newInstance()
			->setSubject('Agence LEON - Réponse suite à votre contact')
			->setFrom(array('christian.yvan@gmail.com' => "Agence Web LEON"))
			->setTo($contact->getEmail())
			->setCharset('utf-8')
			->setContentType('text/html')
			->attach(\Swift_Attachment::fromPath('uploads/images/image_1.jpg')->setDisposition('inline'))
			//->setBody($this->renderView('OCWebAgencyBundle:Contacts:contact.html.twig',array('name' => $name)),'text/html');
			->setBody($this->renderView('OCWebAgencyBundle:Contacts:responseContact.html.twig', array(
				'contact'   	  =>$contact,
				'responseContact' =>$responseContact
			)));

		// Envoi du mail
		$this->get('mailer')
			->send($message);
		return $this->redirectToRoute('admin_contact_index');
		//return $this->render('OCWebAgencyBundle:Home:index.html.twig');
	}
}
