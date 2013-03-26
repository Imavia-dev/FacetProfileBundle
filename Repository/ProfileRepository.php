<?php
namespace Imavia\FacetProfileBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ProfileRepository extends EntityRepository
{
    public function findAll()
    {
        $qb = $this->createQueryBuilder('pro');
        $requete = $qb->getQuery();
        $resultats = $requete->getResult();

        return $resultats;
    }

    public function findByID($id)
    {
        $qb = $this->createQueryBuilder('pro');
        $qb ->select('pro')
            ->from('ImaviaFacetProfileBundle:Profile', 'pro')
            ->where('pro.id=:id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }
}
