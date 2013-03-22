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

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sous Niveau d'une Facette 
 * 
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 * @ORM\Table(name = "imavia_component")
 */
class Component extends ProfileView
{
    /**
     * @ORM\ManyToOne(targetEntity = "Imavia\FacetProfileBundle\Entity\Facet")
     * @ORM\Column(name = "facet_id")
     */
    protected $facet;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="treeleft_id", type="integer",nullable=true)
     */
    protected $treeleft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="treelevel_id", type="integer",nullable=true)
     */
    protected $treelevel;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="treeright_id", type="integer",nullable=true)
     */
    protected $treeright;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="treeroot_id", type="integer",nullable=true)
     */
    protected $treeroot;

    /**
     * @Gedmo\TreeParent
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Component", inversedBy="children")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Component", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    protected $children;

    public function getFacet()
    {
        return $this->facet;
    }

    public function setFacet($facet)
    {
        $this->facet = $facet;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }


}
