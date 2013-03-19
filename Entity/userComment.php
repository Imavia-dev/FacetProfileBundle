<?php
namespace Imavia\FacetProfileBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Imavia_userComment")
 */
class userComment 
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
    protected $commentContent; 
    /**
     * @ORM\Column(type="datetime")
     */
    protected $emissionDate; 
   
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCommentContent() {
        return $this->commentContent;
    }

    public function setCommentContent($commentContent) {
        $this->commentContent = $commentContent;
    }

    public function getEmissionDate() {
        return $this->emissionDate;
    }

    public function setEmissionDate($emissionDate) {
        $this->emissionDate = $emissionDate;
    }

    

}

?>
