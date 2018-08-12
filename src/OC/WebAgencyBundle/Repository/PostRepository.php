<?php

namespace OC\WebAgencyBundle\Repository;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{
	// Sélectionne le nombre de place commandé pour un jour donné et retourne ce nombre.
	/**
	 * @return mixed
	 * @throws \Doctrine\ORM\NoResultException
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function numberPosts()
	{
		$query = $this->createQueryBuilder('q')
			->select('COUNT(q.id)')
			->where('q.isPosted = 1')
			->getQuery()
			->getSingleScalarResult()
		;
		return $query;
	}



	/**
	 * @param string $word
	 *
	 * @return array
	 */
	public function findLikeWord($word, $category)
	{
		$query = $this->createQueryBuilder('q')
            ->leftJoin('q.category', 'c')
			->where('q.title LIKE :word')
			->orWhere('q.content LIKE :word')
            ->andWhere('c.name LIKE :category')
			->setParameter( 'word', "%$word%")
            ->setParameter( 'category', "$category")
			->orderBy('q.date')
			->setMaxResults(5)
			->getQuery()
		;
		$results = $query->getResult();
		return $results;

	}
}
