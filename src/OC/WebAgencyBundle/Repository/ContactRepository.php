<?php

namespace OC\WebAgencyBundle\Repository;

/**
 * ContactRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContactRepository extends \Doctrine\ORM\EntityRepository
{
	/**
	 * @return mixed
	 * @throws \Doctrine\ORM\NoResultException
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function numberContacts()
	{
		$query = $this->createQueryBuilder('q')
			->select('COUNT(q.id)')
			->where('q.responseStatus = 0')
			->getQuery()
			->getSingleScalarResult()
		;
		return $query;
	}
}
