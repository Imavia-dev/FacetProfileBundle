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
 * @ORM\Table(name = "Imavia_userComment")
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
    * @ORM\ManyToOne(targetEntity = "Imavia\FacetProfileBundle\Entity\profileView")
    * @ORM\Column(name = "profileview")
    */
    protected $profileview;
    
    public function getProfileview()
    {
        return $this->profileview;
    }

    public function setProfileview($profileview)
    {
        $this->profileview = $profileview;
    }

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
}
