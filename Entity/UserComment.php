<?php
/**
 * Imavia Bundle Object UserComment
 *    
 * @author Jerome Varini <jerome.varini@imavia.fr>
 * @author Fricker Sebastien <sebastien.fricker@imavia.fr>
 * @link   http://www.imavia.fr Site web Imavia
 * 
 */

namespace Imavia\FacetProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represente les commentaires emis sur les differents elements du profil
 * 
 * @ORM\Entity
 * @ORM\Table(name = "imavia_usercomment")
 */
class UserComment
{
     /**
     * @ORM\Id 
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     * @var int $id ID de la classe
     */

    protected $id;
    /**
     * @ORM\Column(type = "text",name = "commentcontent")
     */
    protected $commentContent;
    /**
     * @ORM\Column(type = "datetime",name = "emissiondate")
     */
    protected $emissionDate;

    /**
    * @ORM\ManyToOne(targetEntity = "Imavia\FacetProfileBundle\Entity\Facet")
    * @ORM\Column(name = "facet_id")
    */
    protected $facetId;

    /**
    * @ORM\ManyToOne(targetEntity = "Imavia\FacetProfileBundle\Entity\Component")
    * @ORM\Column(name = "component_id")
    */
    protected $componentId;

    /**
    * @ORM\ManyToOne(targetEntity = "Imavia\FacetProfileBundle\Entity\Attribute")
    * @ORM\Column(name = "attribute_id")
    */
    protected $attributeId;

    /**
    * @ORM\ManyToOne(targetEntity = "Imavia\FacetProfileBundle\Entity\AttributeValue")
    * @ORM\Column(name = "attributevalue_id")
    */
    protected $attributeValueId;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCommentContent()
    {
        return $this->commentContent;
    }

    public function setCommentContent($commentContent)
    {
        $this->commentContent = $commentContent;
    }

    public function getEmissionDate()
    {
        return $this->emissionDate;
    }

    public function setEmissionDate($emissionDate)
    {
        $this->emissionDate = $emissionDate;
    }
    public function getFacetId()
    {
        return $this->facetId;
    }

    public function setFacetId($facetId)
    {
        $this->facetId = $facetId;
    }

    public function getComponentId()
    {
        return $this->componentId;
    }

    public function setComponentId($componentId)
    {
        $this->componentId = $componentId;
    }

    public function getAttributeId()
    {
        return $this->attributeId;
    }

    public function setAttributeId($attributeId)
    {
        $this->attributeId = $attributeId;
    }

    public function getAttributeValueId()
    {
        return $this->attributeValueId;
    }

    public function setAttributeValueId($attributeValueId)
    {
        $this->attributeValueId = $attributeValueId;
    }
}
