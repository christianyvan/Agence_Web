<?php

namespace OC\WebAgencyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="OC\WebAgencyBundle\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="object", type="string", length=255)
     */
    private $object;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="response_status", type="integer")
	 */
    private $responseStatus;

	/**
	 * ORM\OneToOne (targetEntity="OC\WebAgencyBundle\Entity\ResponseContact",cascade={"persist","remove"})
	 *
	 * Assert\Valid()
	 */
	//private $responseContact;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->date = new \DateTime('NOW');
		$this->responseStatus = 0;
	}



	/**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Contact
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Contact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set object
     *
     * @param string $object
     *
     * @return Contact
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Contact
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Contact
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }


   /**
     * Set responseStatus
     *
     * @param integer $responseStatus
     *
     * @return Contact
     */
    public function setResponseStatus($responseStatus)
    {
        $this->responseStatus = $responseStatus;

        return $this;
    }

    /**
     * Get responseStatus
     *
     * @return boolean
     */
    public function getResponseStatus()
    {
        return $this->responseStatus;
    }

    /**
     * Set responseContact
     *
     * param \OC\WebAgencyBundle\Entity\ResponseContact $responseContact
     *
     * return Contact
     */
  /*  public function setResponseContact(\OC\WebAgencyBundle\Entity\ResponseContact $responseContact = null)
    {
        $this->responseContact = $responseContact;

        return $this;
    }*/

    /**
     * Get responseContact
     *
     * return \OC\WebAgencyBundle\Entity\ResponseContact
     */
   /* public function getResponseContact()
    {
        return $this->responseContact;
    }*/
}
