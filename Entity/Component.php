<?php
namespace Imavia\FacetProfileBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="imavia_component")
 */
class Component extends profileView 
{
     /**
      *
      * @ORM\ManyToOne(targetEntity="Imavia\FacetProfileBundle\Entity\Facet")
      * @ORM\Column(name="facet")
      */
    protected $Facet;
    
    public function getFacet() {
        return $this->Facet;
    }

    public function setFacet($Facet) {
        $this->Facet = $Facet;
    }

        
    function __construct() 
    {
      
    }


}


?>
