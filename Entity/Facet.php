<?php
namespace Imavia\FacetProfileBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="imavia_facet")
 */
class Facet extends profileView 
{
     /**
      *
      * @ORM\ManyToOne(targetEntity="Imavia\FacetProfileBundle\Entity\Component")
      * @ORM\Column(name="components")
      */
    protected $Components;
    
    public function getComponents() 
    {
        return $this->Components;
    }

    public function addComponent(\Imavia\FacetProfileBundle\Entity\Component $Component) 
    {
        $this->Components[] = $Component;
    }
    
    function __construct() 
    {
        parent::__construct();
        $this->Components=new \Doctrine\Common\Collections\ArrayCollection();
    }


}

?>
