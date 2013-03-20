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
      * @ORM\ManyToOne(targetEntity="Imavia\FacetProfileBundle\Entity\Profile")
      * @ORM\Column(name="profile")
      */
    protected $Profile ; 
    
    public function getProfile() 
    {
        return $this->Profile;
    }

    public function setProfile($Profile) 
    {
        $this->Profile = $Profile;
    }

    function __construct() 
    {
    
        
    }  
   

}

?>
