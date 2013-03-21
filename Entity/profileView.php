<?php
/**
 * Imavia Bundle Object ProfileView
 *    
 * @author Jerome Varini <jerome.varini@imavia.fr>
 * @author Fricker Sebastien <sebastien.fricker@imavia.fr>
 */
namespace Imavia\FacetProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe Abstraite permettant de regrouper les elements commun au profil utilisateur
 * @ORM\MappedSuperclass
 */
abstract class ProfileView
{
    
    /**
     * @ORM\Id 
     * @ORM\Column(name = "id", type = "integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     * @var int $id ID de la classe
     */
    protected $Id;
    /**
     * @ORM\Column(type = "text",name = "description")
     */
    protected $description;
    /**
     * @ORM\Column(type = "string",length = 255,name = "name")
     */
    protected $name;
    /**
     * @ORM\Column(type = "datetime",name = "creationdate")
     */
    protected $creationDate;
    /**
     * @ORM\Column(type = "datetime",name = "lastmodificationdate")
     */
    protected $lastModificationDate;
   
    /**
     *  getter Setter 
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getLastModificationDate()
    {
        return $this->lastModificationDate;
    }

    public function setLastModificationDate($lastModificationDate)
    {
        $this->lastModificationDate = $lastModificationDate;
    }
}
