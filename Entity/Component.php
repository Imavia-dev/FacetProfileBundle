<?php
/**
 * Imavia Bundle Object Component
 *    
 * @author Jerome Varini <jerome.varini@imavia.fr>
 * @author Fricker Sebastien <sebastien.fricker@imavia.fr>
 * @link   http://www.imavia.fr Site web Imavia
 * 
 */
namespace Imavia\FacetProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sous Niveau d'une Facette 
 * 
 * @ORM\Entity
 * @ORM\Table(name = "imavia_component")
 */
class Component extends ProfileView
{
    /**
     * @ORM\ManyToOne(targetEntity = "Imavia\FacetProfileBundle\Entity\Facet")
     * @ORM\Column(name = "facet")
     */
    protected $Facet;
    
    public function getFacet()
    {
        return $this->Facet;
    }

    public function setFacet($Facet)
    {
        $this->Facet = $Facet;
    }
}
