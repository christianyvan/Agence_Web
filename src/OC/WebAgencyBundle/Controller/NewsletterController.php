<?php
// src/OC/WebAgencyBundle/Controller/NewsletterController.php

namespace OC\WebAgencyBundle\Controller;

use Doctrine\DBAL\Types\TextType;
use OC\WebAgencyBundle\Form\ContactType;
use OC\WebAgencyBundle\Form\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Welp\MailchimpBundle\Event\SubscriberEvent;
use Welp\MailchimpBundle\Subscriber\Subscriber;
use OC\WebAgencyBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;

class NewsletterController extends Controller
{
    public function newUserAction(Request $request)
    {
        // Abdel : Ajout formulaire NewsLetter
        // on crée un objet contact
        $contact = new Contact();
        $contact->setObject("Newsletter");
        $contact->setMessage("Newsletter");

        // On crée le Form $contact
        //$form   = $this->get('form.factory')->create(NewsletterType::class, $contact);
        $form=$this->createForm(NewsletterType::class,$contact);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                //$subscriber = new Subscriber($user->getEmail(), [
                $subscriber = new Subscriber($contact->getEmail(), [
                    'FNAME' => $contact->getFirstName(),
                    'LNAME' => $contact->getLastName(),
                ], [
                    'language' => 'fr'
                ]);

                $this->container->get('event_dispatcher')->dispatch(
                    SubscriberEvent::EVENT_SUBSCRIBE,
                    new SubscriberEvent('b21eef2169', $subscriber)
                );
                $em->flush();
            }

            $request->getSession()->getFlashBag()->add('newsletter', 'Merci pour votre inscription');

            return $this->redirectToRoute('oc_web_agency_newsletter');
        }

        return $this->render('OCWebAgencyBundle:Newsletter:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    public function newUserAction1()
    {
        $emailuser = 'abdel.montet@cnd.fr';
        $firstname = 'abdel';
        $lastname = 'montet';

        //$subscriber = new Subscriber($user->getEmail(), [
        $subscriber = new Subscriber($emailuser, [
            'FNAME' => $firstname,
            'LNAME' => $lastname,
        ], [
            'language' => 'fr'
        ]);

        $this->container->get('event_dispatcher')->dispatch(
            SubscriberEvent::EVENT_SUBSCRIBE,
            new SubscriberEvent('b21eef2169', $subscriber)
        );
    }

    public function unsubscribeUser(User $user)
    {
        $subscriber = new Subscriber($user->getEmail());

        $this->container->get('event_dispatcher')->dispatch(
            SubscriberEvent::EVENT_UNSUBSCRIBE,
            new SubscriberEvent('votre_id_liste', $subscriber)
        );
    }

    public function updateUser(User $user)
    {
        $subscriber = new Subscriber($user->getEmail(), [
            'FIRSTNAME' => $user->getFirstname(),
            'LASTNAME' => $user->getFirstname(),
        ], [
            'language' => 'en'
        ]);

        $this->container->get('event_dispatcher')->dispatch(
            SubscriberEvent::EVENT_UPDATE,
            new SubscriberEvent('votre_id_liste', $subscriber)
        );
    }

    public function deleteUser(User $user)
    {
        $subscriber = new Subscriber($user->getEmail());

        $this->container->get('event_dispatcher')->dispatch(
            SubscriberEvent::EVENT_DELETE,
            new SubscriberEvent('votre_id_liste', $subscriber)
        );
    }
}