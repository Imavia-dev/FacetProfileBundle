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
   
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    function __construct() 
    {
       
    }

    
    public function saveXmlProfile($url)
    {
        
    }
    public function loadXmlProfile($url)
    {
        
    }
    
}

?>
