<?php
namespace Imavia\FacetProfileBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="imavia_profile")
 */
class Profile {
   
     /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int $id ID de la classe
     */
    protected $id ; 
   
     /**
      *
      * @ORM\ManyToOne(targetEntity="Imavia\FacetProfileBundle\Entity\Facet")
      * @ORM\Column(name="facets")
      */
    protected $Facets; 


    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getFacets() 
    {
        return $this->Facets;
    }

    public function addFacets($Facet) 
    {
        $this->Facets[] = $Facet;
    }

    function __construct() 
    {
         $this->Facets=new \Doctrine\Common\Collections\ArrayCollection();
    }

    
    public function saveXmlProfile($url)
    {
        
    }
    public function loadXmlProfile($url)
    {
        
    }
    
}

?>
