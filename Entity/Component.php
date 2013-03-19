<?php
namespace Imavia\FacetProfileBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Imavia_Component")
 */
class Component extends profileView 
{
     /**
      *
      * @ORM\ManyToOne(targetEntity="Imavia\FacetProfileBundle\Entity\Attribute")
      */
    protected $Attributes;
    
    public function getAttributes() 
    {
        return $this->Attributes;
    }

    public function addAttribute(\Imavia\FacetProfileBundle\Entity\Attribute $Attribute) 
    {
        $this->Attributes[] = $Attribute;
    }
    
    function __construct() 
    {
        parent::__construct();
        $this->Attributes=new \Doctrine\Common\Collections\ArrayCollection();
    }


}


?>
