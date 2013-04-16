<?php

namespace Imavia\FacetProfileBundle\Repository;

use Doctrine\ORM\EntityRepository;


class UserCommentRepository extends EntityRepository
{
    public function findAll()
    {
        $qb = $this->createQueryBuilder('uc');
        $requete = $qb->getQuery();
        $resultats = $requete->getResult();

        return $resultats;
    }

    public function findByFacetId($idFacet)
    {
        $qb = $this->createQueryBuilder('uc');
        $qb ->select('uc')
            ->from('ImaviaFacetProfileBundle:UserComment', 'uc')
            ->where('uc.facetId=:id')
            ->setParameter('id', $idFacet);

        return $qb->getQuery()->getResult();
    }

    public function findByComponentId($idComponent)
    {
        $qb = $this->createQueryBuilder('uc');
        $qb ->select('uc')
            ->from('ImaviaFacetProfileBundle:UserComment', 'uc')
            ->where('uc.componentId=:id')
            ->setParameter('id', $idComponent);

        return $qb->getQuery()->getResult();
    }

    public function findByAttributeId($idAttribute)
    {
        $qb = $this->createQueryBuilder('uc');
        $qb ->select('uc')
            ->from('ImaviaFacetProfileBundle:UserComment', 'uc')
            ->where('uc.attributeId=:id')
            ->setParameter('id', $idAttribute);

        return $qb->getQuery()->getResult();
    }

    public function findByAttributeValueId($idAttributeValue)
    {
        $qb = $this->createQueryBuilder('uc');
        $qb ->select('uc')
            ->from('ImaviaFacetProfileBundle:UserComment', 'uc')
            ->where('uc.attributeValueId=:id')
            ->setParameter('id', $idAttributeValue);

        return $qb->getQuery()->getResult();
    }
}
