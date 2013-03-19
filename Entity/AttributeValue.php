<?php
namespace Imavia\FacetProfileBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="imavia_attributeValue")
 */

class AttributeValue extends profileView
{
    
    /**
     * @ORM\Column(type="datetime",name="evaluationdate")
     */
    protected $evaluationDate; 
    /**
     * @ORM\Column(type="string",name="value")
     */
    protected $value;
     /**
      *
      * @ORM\OneToOne(targetEntity="Imavia\FacetProfileBundle\Entity\Scale")
      * @ORM\Column(name="scale")
      */
    protected $Scale ; 
}

?>
