<?php

namespace Imavia\FacetProfileBundle\Repository;

use Doctrine\ORM\EntityRepository;


class AttributeRepository extends EntityRepository
{

    public function findAll()
    {
        $qb = $this->createQueryBuilder('a');
        $requete = $qb->getQuery();
        $resultats = $requete->getResult();

        return $resultats;
    }

    public function findByID($id)
    {
        $qb = $this->createQueryBuilder('a');
        $qb ->select('a')
            ->from('ImaviaFacetProfileBundle:Attribute', 'a')
            ->where('a.id=:id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }

    public function findByComponent($inClause)
    {

        $sql = "SELECT a 
               FROM Imavia\FacetProfileBundle\Entity\Attribute a
               WHERE a.component IN (" . implode(',', $inClause) . ")";

        return $this->_em->createQuery($sql)->getResult();
    }
}

