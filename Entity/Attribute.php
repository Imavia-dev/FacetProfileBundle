<?php
namespace Imavia\FacetProfileBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="imavia_attribute")
 */

class Attribute extends profileView
{
    /**
      *
      * @ORM\ManyToOne(targetEntity="Imavia\FacetProfileBundle\Entity\attributeValue")
      * @ORM\Column(name="values")
      */
    private $Values ;
    
    public function getValues() 
    {
        return $this->Values;
    }

    public function addValue(\Imavia\FacetProfileBundle\Entity\AttributeValue $Value) 
    {
        $this->Values[] = $Value;
    }
    
    function __construct() 
    {
      parent::__construct();
      $this->Attributes=new \Doctrine\Common\Collections\ArrayCollection();    
    }


    
}

?>
