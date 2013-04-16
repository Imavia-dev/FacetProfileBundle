<?php

namespace Imavia\FacetProfileBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ComponentRepository extends EntityRepository
{


    public function findByID($id)
    {
        $qb = $this->createQueryBuilder('c');
        $qb ->select('c')
            ->from('ImaviaFacetProfileBundle:Component', 'c')
            ->where('c.id=:id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }

    public function findByFacet($name,array $compIds)
    {
          $em = $this->container->get('doctrine.orm.entity_manager');
          $sql = "
            SELECT c 
            FROM Imavia\FacetProfileBundle\Entity\Component c
            WHERE c.name='". $name ."' AND c.facet IN (". implode(',', $compIds) . ")";

          return $em -> createQuery($sql)-> getResult();

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

