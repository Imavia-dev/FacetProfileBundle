<?php
/**
 * Imavia Bundle Object AttributeValue
 *    
 * @author Jerome Varini <jerome.varini@imavia.fr>
 *         Fricker Sebastien <sebastien.fricker@imavia.fr>
 * @link   http://www.imavia.fr Site web Imavia
 * 
 */
namespace Imavia\FacetProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe Abstraite representant un element du profile
 * 
 * @ORM\Entity
 * @ORM\Table(name = "imavia_attributeValue")
 */
class AttributeValue extends ProfileView
{
    /**
     * @ORM\Column(type = "datetime",name = "evaluationdate")
     */
    protected $evaluationDate;
    /**
     * @ORM\ManyToOne(targetEntity = "Imavia\FacetProfileBundle\Entity\Attributes")
     * @ORM\Column(type = "string",name = "attribute_id")
     */
    protected $attribute;
        
    /**
    * @ORM\OneToOne(targetEntity = "Imavia\FacetProfileBundle\Entity\Scale")
    * @ORM\Column(name = "scale_id")
    */
    protected $scale;
    
    /**
     * getter Attribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Setter Attribute
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * 
     */
    public function getEvaluationDate()
    {
        return $this->evaluationDate;
    }
    /**
     * 
     */
    public function setEvaluationDate($evaluationDate)
    {
        $this->evaluationDate = $evaluationDate;
    }
    
    /**
     * 
     */
    public function getScale()
    {
        return $this->Scale;
    }
    /**
     * 
     */
    public function setScale($Scale)
    {
        $this->Scale = $Scale;
    }
}
