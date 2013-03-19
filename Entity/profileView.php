<?php
namespace Imavia\FacetProfileBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */ 
abstract class profileView {
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int $id ID de la classe
     */
    
    protected $id ;
    /**
     * @ORM\Column(type="text")
     */
    protected  $Description ; 
    /**
     * @ORM\Column(type="string",length=255)
     */
    protected $Name; 
    /**
     * @ORM\Column(type="datetime")
     */
    protected  $creationDate ; 
    /**
     * @ORM\Column(type="datetime")
     */
    protected $lastModificationDate ;
    
     /**
     * @ORM\ManyToOne(targetEntity="Imavia\FacetProfileBundle\Entity\userComment")
     */
     protected $Comments ;
    
     function __construct()
     {
         //Initialisation de la collection de commentaires 
         $this->Comments=new \Doctrine\Common\Collections\ArrayCollection();
     }

     function __destruct()
     {
         
     }    

    /* getter Setter */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDescription() {
        return $this->Description;
    }

    public function setDescription($Description) {
        $this->Description = $Description;
    }

    public function getName() {
        return $this->Name;
    }

    public function setName($Name) {
        $this->Name = $Name;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function getLastModificationDate() {
        return $this->lastModificationDate;
    }

    public function setLastModificationDate($lastModificationDate) {
        $this->lastModificationDate = $lastModificationDate;
    }
    
    public function getComments() {
        return $this->Comments;
    }

    /*
     * Ajoute un commentaire au tableau de commentaire 
     * @var usercomment $Comment 
     */
    
    public function addComments(\Imavia\FacetProfileBundle\Entity\userComment $Comment) {
        $this->Comments[] = $Comment;
    }


}

?>
