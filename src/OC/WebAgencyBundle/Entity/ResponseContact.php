<?php

namespace OC\WebAgencyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ResponseContact
 *
 * @ORM\Table(name="response_contact")
 * @ORM\Entity(repositoryClass="OC\WebAgencyBundle\Repository\ResponseContactRepository")
 */
class ResponseContact
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
     * @ORM\Column(name="content_response", type="text", nullable=true)
     */
    private $contentResponse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="contactId", type="integer")
     */
    private $contactId;


	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->date = new \DateTime('NOW');

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
     * Set contentResponse
     *
     * @param string $contentResponse
     *
     * @return ResponseContact
     */
    public function setContentResponse($contentResponse)
    {
        $this->contentResponse = $contentResponse;

        return $this;
    }

    /**
     * Get contentResponse
     *
     * @return string
     */
    public function getContentResponse()
    {
        return $this->contentResponse;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ResponseContact
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
     * Set contactId
     *
     * @param integer $contactId
     *
     * @return ResponseContact
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;

        return $this;
    }

    /**
     * Get contactId
     *
     * @return int
     */
    public function getContactId()
    {
        return $this->contactId;
    }
}
