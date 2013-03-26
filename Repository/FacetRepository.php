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

    public function findByID($id)
    {
        $qb = $this->createQueryBuilder('f');
        $qb ->select('f')
            ->from('ImaviaFacetProfileBundle:Facet', 'f')
            ->where('f.id=:id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
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

    public function getFacetByName($name, $idProfil)
    {
        $qb = $this->createQueryBuilder('f');
        $qb ->select('f')
            ->from('ImaviaFacetProfileBundle:Facet', 'f1')
            ->where('f1.name=:name')
            ->andWhere('f1.profile=:idprofil')
            ->setParameter('name', $name)
            ->setParameter('idprofil', $idProfil);

        return $qb->getQuery()->getResult();
    }
}

