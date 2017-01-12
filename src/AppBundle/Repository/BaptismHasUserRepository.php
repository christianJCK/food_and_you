<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Baptism;

/**
 * BaptemHasUserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BaptismHasUserRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * this function find out if there are other people on this baptism
     * allowing us to know if we have to remove baptism in case of
     * cancelled payment
     * @param Baptism $baptism
     * @return array
     */
    public function findOtherByBaptism(Baptism $baptism){
        return $this->createQueryBuilder('bhu')
            ->select('COUNT(bhu.id)')
            ->where('bhu.baptism = :baptism')
            ->andWhere('bhu.role = 1')
            ->setParameter('baptism', $baptism)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
