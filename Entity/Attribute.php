<?php
/**
 * Imavia Bundle Object Attribute
 *    
 * @author Jerome Varini <jerome.varini@imavia.fr>
 * @author Fricker Sebastien <sebastien.fricker@imavia.fr>
 * @link   http://www.imavia.fr Site web Imavia
 * 
 */
namespace Imavia\FacetProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represente un attribut du Profile à facette (Imavia)
 * 
 * @ORM\Entity
 * @ORM\Table(name = "imavia_attribute")
 */
class Attribute extends ProfileView
{

    /**
     * @ORM\ManyToOne(targetEntity = "Imavia\FacetProfileBundle\Entity\Component")
     * @ORM\Column(name = "component_id")
     */
    protected $component;

    /**
     * Getter Component
     * 
     * @return Component
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * Setter Component 
     * 
     * @param Component $Component Representant un composant du profile à facette
     * 
     * @return none
     */
    public function setComponent($component)
    {
        $this->component = $component;
    }
}
