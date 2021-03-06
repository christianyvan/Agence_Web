<?php
/**
 * Created by PhpStorm.
 * User: Christian
 * Date: 16/07/2018
 * Time: 17:44
 */

namespace OC\WebAgencyBundle\Repository;


/**
 * UserRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
	/**
	 * @return mixed
	 * @throws \Doctrine\ORM\NoResultException
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function numberAdmins()
	{
		$query = $this->createQueryBuilder('q')
			->select('COUNT(q.id)')
			->getQuery()
			->getSingleScalarResult()
		;
		return $query;
	}

}