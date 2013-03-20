<?php
namespace Imavia\FacetProfileBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="imavia_attributeValue")
 */

class AttributeValue extends profileView
{
    
    /**
     * @ORM\Column(type="datetime",name="evaluationdate")
     */
    protected $evaluationDate; 
    /**
     * @ORM\ManyToOne(targetEntity="Imavia\FacetProfileBundle\Entity\Attributes")
     * @ORM\Column(type="string",name="attributes")
     */
    protected $attribute ;
        
      /**
      *
      * @ORM\OneToOne(targetEntity="Imavia\FacetProfileBundle\Entity\Scale")
      * @ORM\Column(name="scale")
      */
    protected $Scale ; 
    
    
    public function getAttribute() 
    {
        return $this->attribute;
    }

    public function setAttribute($attribute) 
    {
        $this->attribute = $attribute;
    }

    public function getEvaluationDate() 
    {
        return $this->evaluationDate;
    }

    public function setEvaluationDate($evaluationDate) 
    {
        $this->evaluationDate = $evaluationDate;
    }
  
    public function getScale() 
    {
        return $this->Scale;
    }

    public function setScale($Scale) 
    {
        $this->Scale = $Scale;
    }

    
    
   
   
}

?>
