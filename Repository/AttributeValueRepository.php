<?php

namespace Imavia\FacetProfileBundle\Repository;

use Doctrine\ORM\EntityRepository;


class AttributeValueRepository extends EntityRepository
{
    public function findAll()
    {
        $qb = $this->createQueryBuilder('av');
        $requete = $qb->getQuery();
        $resultats = $requete->getResult();

        return $resultats;
    }

    public function findByID($id)
    {
        $qb = $this->createQueryBuilder('av');
        $qb ->select('av')
            ->from('ImaviaFacetProfileBundle:AttributeValue', 'av')
            ->where('av.id=:id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }

    public function findByAttribute($idAttributes)
    {
        $sql = "SELECT av 
               FROM Imavia\FacetProfileBundle\Entity\AttributeValue av
               WHERE av.attribute=" .$idAttributes ;

        return $this->_em->createQuery($sql)->getResult();
    }
}

