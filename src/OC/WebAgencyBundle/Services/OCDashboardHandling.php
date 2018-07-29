<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 16/07/2018
 * Time: 16:05
 */

namespace OC\WebAgencyBundle\Services;
use Doctrine\ORM\EntityManager;


class OCDashboardHandling
{

	private $em;



	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}



	/**
	 *
	 * @param EntityManager $em
	 * @return mixed
	 * @throws \Doctrine\ORM\NoResultException
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function countPosts(EntityManager $em){

		$this->em = $em;

		$numberPosts = $em->getRepository('OCWebAgencyBundle:Post')->numberPosts();

		/*	foreach($tables as $table_name => $table)
			{
				$colorTable = $this->getColor($admin,$posts,comments,$colors);
				$nbrInTable[$table] = $this->_dashboardManager->inTable($table);
			}
		*/
		return $numberPosts;
	}

	/**
	 *
	 * @param EntityManager $em
	 * @return mixed
	 * @throws \Doctrine\ORM\NoResultException
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function countComments(EntityManager $em){

		$this->em = $em;

		$numberComments = $em->getRepository('OCWebAgencyBundle:Comment')->numberComments();

		return $numberComments;
	}

	/**
	 * @param EntityManager $em
	 * @return mixed
	 * @throws \Doctrine\ORM\ORMException
	 */
	/*public function countUsers(EntityManager $em){

		$this->em = $em;

		$numberUsers = $em->getRepository('OCWebAgencyBundle:User')->numberUsers();

		return $numberUsers;
	}*/


}