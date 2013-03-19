<?php
namespace Imavia\FacetProfileBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Imavia_AttributeValue")
 */

class AttributeValue extends profileView
{
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $evaluationDate; 
    /**
     * @ORM\Column(type="string")
     */
    protected $value;
     /**
      *
      * @ORM\OneToOne(targetEntity="Imavia\FacetProfileBundle\Entity\Scale")
      */
    protected $idScale ; 
}

?>
