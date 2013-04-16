<?php

namespace Imavia\FacetProfileBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ScaleRepository extends EntityRepository
{
    public function findAll()
    {
        $qb = $this->createQueryBuilder('s');
        $requete = $qb->getQuery();
        $resultats = $requete->getResult();

        return $resultats;
    }

    public function findByID($id)
    {
        $qb = $this->createQueryBuilder('s');
        $qb ->select('s')
            ->from('ImaviaFacetProfileBundle:Scale', 's')
            ->where('s.id=:id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }
}
