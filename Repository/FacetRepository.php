<?php

namespace Imavia\FacetProfileBundle\Repository;

use Doctrine\ORM\EntityRepository;


class FacetRepository extends EntityRepository
{
    public function findAll()
    {
        $qb = $this->createQueryBuilder('f');
        $requete = $qb->getQuery();
        $resultats = $requete->getResult();

        return $resultats;
    }

    public function findById($facetId,$name)
    {
        {
        $sql = "
            SELECT f
            FROM Imavia\FacetProfileBundle\Entity\Facet f
            WHERE f.profile = $facetId
            AND f.name='". $name . "'"
        ;

        return $this->_em->createQuery($sql)
            ->getResult();
        }
    }

    public function findByProfile($idProfil)
    {
        $qb = $this->createQueryBuilder('f');
        $qb ->select('f')
            ->from('ImaviaFacetProfileBundle:Facet', 'f')
            ->where('f.profile=:id')
            ->setParameter('id', $idProfil);

        return $qb;
    }

    public function findByFacetByName($name)
    {
        $qb = $this->createQueryBuilder('f');
        $qb ->select('f')
            ->from('ImaviaFacetProfileBundle:Facet', 'f1')
            ->where('f1.name=:name')
            ->setParameter('name', $name);

        return $qb->getQuery()->getResult();
    }
}

