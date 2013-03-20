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
      * @ORM\ManyToOne(targetEntity="Imavia\FacetProfileBundle\Entity\Component")
      * @ORM\Column(name="component")
      */
    private $component ;
    
    public function getComponent() 
    {
        return $this->component;
    }

    public function setComponent($component) 
    {
        $this->component = $component;
    }

        
    function __construct() 
    {
      
    }


    
}

?>
