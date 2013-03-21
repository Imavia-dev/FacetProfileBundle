<?php
/**
 * Imavia Bundle Object Facet
 *    
 * @author Jerome Varini <jerome.varini@imavia.fr>
 * @author Fricker Sebastien <sebastien.fricker@imavia.fr>
 * @link   http://www.imavia.fr Site web Imavia
 * 
 */
namespace Imavia\FacetProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represente le plus haut niveau du profile à facette 
 * 
 * @ORM\Entity
 * @ORM\Table(name = "imavia_facet")
 */
class Facet extends ProfileView
{
      /**
      * @ORM\ManyToOne(targetEntity = "Imavia\FacetProfileBundle\Entity\Profile")
      * @ORM\Column(name = "profile")
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
}
