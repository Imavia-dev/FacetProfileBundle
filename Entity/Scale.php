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
     * @ORM\Column(type="integer",length=4,name="minvalue")
     */
    protected $minValue; 
    /**
     * @ORM\Column(type="integer",length=4,name="maxvalue")
     */
    protected $maxValue; 
    
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

    public function getMinValue() {
        return $this->minValue;
    }

    public function setMinValue($minValue) {
        $this->minValue = $minValue;
    }

    public function getMaxValue() {
        return $this->maxValue;
    }

    public function setMaxValue($maxValue) {
        $this->maxValue = $maxValue;
    }


    
    
}

?>
