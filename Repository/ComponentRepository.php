<?php

namespace Imavia\FacetProfileBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ComponentRepository extends EntityRepository
{
    public function findAll()
    {
        $qb = $this->createQueryBuilder('c');
        $requete = $qb->getQuery();
        $resultats = $requete->getResult();

        return $resultats;
    }

    public function findByID($id)
    {
        $qb = $this->createQueryBuilder('c');
        $qb ->select('c')
            ->from('ImaviaFacetProfileBundle:Component', 'c')
            ->where('c.id=:id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }

    public function findByFacet($idFacet)
    {
        $qb = $this->createQueryBuilder('c');
        $qb ->select('c')
            ->from('ImaviaFacetProfileBundle:Component', 'c')
            ->where('c.facet=:id')
            ->setParameter('id', $idFacet);

        return $qb->getQuery()->getResult();
    }

    public function findByName($name,$idFacet)
    {
        $qb = $this->createQueryBuilder('c');
        $qb ->select('c.id')
            ->from('ImaviaFacetProfileBundle:Component', 'c')
            ->where('c.name=:name')
            ->andWhere('c.facet=:idfacet')
            ->setParameter('name', $name)
            ->setParameter('idfacet', $idFacet);

        return $qb->getQuery()->getResult();
    }
    public function findByParent($id)
    {
        $qb = $this->createQueryBuilder('ch');
        $qb->select(ch)
           ->from('ImaviaFacetProfileBundle:Component', 'ch')
           ->where('c.parent=:id')
           ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }



}

