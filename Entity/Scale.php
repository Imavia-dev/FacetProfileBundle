<?php
namespace Imavia\FacetProfileBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Imavia_Scale")
 */
class Scale 
{
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int $id ID de la classe
     */
    protected $id; 
 
    /**
     * @ORM\Column(type="text")
     */
    protected $description; 
    /**
     * @ORM\Column(type="datetime")
     */
    protected $date; 
    /**
     * @ORM\Column(type="integer",length=4,name="minval")
     */
    protected $minVal; 
    /**
     * @ORM\Column(type="integer",length=4,name="maxval")
     */
    protected $maxVal; 
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getMinVal() {
        return $this->minVal;
    }

    public function setMinVal($minVal) {
        $this->minVal = $minVal;
    }

    public function getMaxVal() {
        return $this->maxVal;
    }

    public function setMaxVal($maxVal) {
        $this->maxVal = $maxVal;
    }


    
    
}

?>
