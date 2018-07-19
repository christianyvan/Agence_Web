<?php

namespace OC\WebAgencyBundle\Controller;

use OC\WebAgencyBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{
    /**
     * Lists all contacton entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contacts = $em->getRepository('OCWebAgencyBundle:Contact')->findAll();

        return $this->render('contact/index.html.twig', array(
            'contacts' => $contacts,
        ));
    }

    /**
     * Creates a new contacton entity.
     *
     */
    public function newAction(Request $request)
    {
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
            'contacton' => $contact,
            'form' => $form->createView(),
        ));
    }

	/**
	 * Finds and displays a contacton entity.
	 * @param Contact $contact
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function showAction(Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);

        return $this->render('contact/show.html.twig', array(
            'contact' => $contact,
            'delete_form' => $deleteForm->createView(),
        ));
    }

	/**
	 * Displays a form to edit an existing contacton entity.
	 * @param Request $request
	 * @param Contact $contact
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
    public function editAction(Request $request, Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);
        $editForm = $this->createForm('OC\WebAgencyBundle\Form\ContactType', $contact);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_contact_edit', array('id' => $contact->getId()));
        }

        return $this->render('contact/edit.html.twig', array(
            'contacton' => $contact,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a contacton entity.
     *
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
     * Creates a form to delete a contacton entity.
     *
     * @param Contact $contact The contacton entity
     *
     * @return \Symfony\Component\Form\Form The form
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

		// On réaffiche l'ensemble de la réservation avec le détail
		$contact = $this->getDoctrine()
			->getManager()
			->getRepository('Contact.php')
			->find($id);

		// Préparation de l'email avec les informations de la commande
		$message = \Swift_Message::newInstance()
			->setSubject('Agence LEON - Votre demande à bien été reçu merci pour votre commentaire')
			->setFrom(array('christian.yvan@gmail.com' => "Agence Web LEON"))
			->setTo($contact->getContactEmail())
			->setCharset('utf-8')
			->setContentType('text/html')
			->attach(\Swift_Attachment::fromPath('uploads/images/image_1.jpg')->setDisposition('inline'))
			//->setBody($this->renderView('OCWebAgencyBundle:Contacts:contact.html.twig',array('name' => $name)),'text/html');
			->setBody($this->renderView('OCWebAgencyBundle:Contacts:contacts.html.twig', array(
				'contact'   	  =>$contact
			)));

		// Envoi du mail
		$this->get('mailer')
			->send($message);


	}
}
