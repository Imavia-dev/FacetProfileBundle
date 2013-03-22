<?php
/**
 * Imavia Bundle Object Profile
 *    
 * @author Jerome Varini <jerome.varini@imavia.fr>
 * @author Fricker Sebastien <sebastien.fricker@imavia.fr>
 * @link   http://www.imavia.fr Site web Imavia
 * 
 */
namespace Imavia\FacetProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represente le profile utilisateur en entier 
 * 
 * @ORM\Entity
 * @ORM\Table(name = "imavia_profile")
 */
class Profile
{
    /**
     * @ORM\Id 
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     * @var int $id ID de la classe
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function saveXmlProfile($url)
    {
        /**
         *  TODO Implements the SaveXmlProfile
         */
    }
    public function loadXmlProfile($url)
    {
        /**
         * TODO Implements the LoadXmlProfile
         * 
         */
    }
}
