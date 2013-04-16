<?php

namespace Imavia\FacetProfileBundle\ProfileModel;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;
use Imavia\FacetProfileBundle\Validator\AllowedCharacters;

/** Classe Pour la génération du Formulaire d'ajout de profile
* 
*/

class AttributeModel
{
    private $civilite;

    /**
     *
     * @assert\MaxLength(
     *     limit=32,
     *     message="Ce bloc doit contenir au maximum {{ limit }} caractères")
     * 
     * @assert\MinLength(
     *     limit=2,
     *     message="Ce bloc doit contenir au minimum  {{ limit }} caractères"
     * )
     * 
     * @AllowedCharacters(
     *     allowLetters=true,
     *     allowNumbers=false,
     *     specialChars="'|-",
     *     message="Le nom contient des caractères invalides",
     *     maxRepeatedchars=3
     * )
     * @assert\NotBlank
     */

    private $nom;

     /**
     *
     * @assert\MaxLength(
     *     limit=32,
     *     message="Ce bloc doit contenir au maximum {{ limit }} caractères"
     * )
     * @assert\MinLength(
     *     limit=2,
     *     message="Ce bloc doit contenir au minimum  {{ limit }} caractères"
     * )
     * @AllowedCharacters(
     *    allowLetters=true,
     *     allowNumbers=false,
     *     specialChars="'|-",
     *     message="Le prénom contient des caractères invalides",
     *     maxRepeatedchars=3
     * )
     * @assert\NotBlank
     */

    private $prenom;

    private $ddn;



    private $photo;

     /**
     *
     * @assert\MaxLength(
     *     limit=64,
     *     message="Ce bloc doit contenir au maximum {{ limit }} caractères"
     * )
     * @assert\MinLength(
     *     limit=2,
     *     message="Ce bloc doit contenir au minimum  {{ limit }} caractères"
     * )
     * @AllowedCharacters(
     *     allowLetters=true,
     *     allowNumbers=true,
     *     specialChars="'|-|,|.|(|)",
     *     message="Adresse ligne 1 contient des caractères invalides",
     *     maxRepeatedchars=6
     * )
     */

    private $ligneP;

     /**
     *
     * @assert\MaxLength(
     *     limit=64,
     *     message="Ce bloc doit contenir au maximum {{ limit }} caractères"
     * )
     * @assert\MinLength(
     *    limit=2,
     *    message="Ce bloc doit contenir au minimum  {{ limit }} caractères"
      * )
     * @AllowedCharacters(
     *     allowLetters=true,
     *     allowNumbers=true,
     *     specialChars="'|-|,|.|(|)",
     *     message="Adresse ligne 2 contient des caractères invalides",
     *     maxRepeatedchars=6
     * )
     */
    private $ligneS;
    /**
     *
     * @assert\MaxLength(
     *    limit=5,
     *    message="Ce bloc doit contenir au maximum {{ limit }} caractères")
     * @assert\MinLength(
     *    limit=4,
     *    message="Ce bloc doit contenir au minimum  {{ limit }} caractères")
     * @AllowedCharacters(
     *    allowLetters=false,
     *    allowNumbers=true,
     *    message="Le code postal contient des caractères invalides",
     *    maxRepeatedchars=6
     * )
     */

    private $codepostal;

    /**
     *
     * @assert\MaxLength(
     *    limit=32,
     *    message="Ce bloc doit contenir au maximum {{ limit }} caractères")
     * @assert\MinLength(
     *    limit=2,
     *    message="Ce bloc doit contenir au minimum  {{ limit }} caractères")
     * @AllowedCharacters(
     *    allowLetters=true,
     *    allowNumbers=false,
     *    message="la ville contient des caractères invalides",
     *    maxRepeatedchars=3
     * )
     */

    private $ville;
    private $pays;

     /**
     *
     * @assert\MaxLength(
     *    limit=12,
     *    message="Ce bloc doit contenir au maximum {{ limit }} caractères")
     * @assert\MinLength(
     *    limit=2,
     *    message="Ce bloc doit contenir au minimum  {{ limit }} caractères")
     * @AllowedCharacters(
     *    allowLetters=false,
     *    allowNumbers=true,
     *    specialChars="+",
     *    message="le téléphone 1 contient des caractères invalides",
     *    maxRepeatedchars=4
     * )
     */

    private $telephoneP;

    /**
     *
     * @assert\MaxLength(
     *    limit=12,
     *    message="Ce bloc doit contenir au maximum {{ limit }} caractères")
     * @assert\MinLength(
     *    limit=2,
     *    message="Ce bloc doit contenir au minimum  {{ limit }} caractères")
     * @AllowedCharacters(
     *    allowLetters=false,
     *    allowNumbers=true,
     *    specialChars="+",
     *    message="le téléphone 2 contient des caractères invalides",
     *    maxRepeatedchars=4
     * )
     */
    private $telephoneS;

      /**
     *
     * @assert\MaxLength(
     *     limit=16,
     *     message="Ce bloc doit contenir au maximum {{ limit }} caractères"
     * )
     * @assert\MinLength(
     *     limit=2,
     *     message="Ce bloc doit contenir au minimum  {{ limit }} caractères"
     * )
     * @AllowedCharacters(
     *    allowLetters=true,
     *    allowNumbers=false,
     *    specialChars="'|-",
     *    message="Le pseudo contient des caractères invalides",
     *    maxRepeatedchars=3
     * )
     * @assert\NotBlank
     */


     private $pseudo;


     /**
     *
     * @assert\NotBlank
     */
    private $mail;

    private $mailsecours;
    private $facebook;
    private $googleplus;
    private $twitter;
    private $skype;
    private $viadeo;
    private $linkedin;


    public function getCivilite()
    {
        return $this->civilite;
    }

    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getDdn()
    {
        return $this->ddn;
    }

    public function setDdn($ddn)
    {
        $this->ddn = $ddn;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getLigneP()
    {
        return $this->ligneP;
    }

    public function setLigneP($ligneP)
    {
        $this->ligneP = $ligneP;
    }

    public function getLigneS()
    {
        return $this->ligneS;
    }

    public function setLigneS($ligneS)
    {
        $this->ligneS = $ligneS;
    }

    public function getCodepostal()
    {
        return $this->codepostal;
    }

    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function getPays()
    {
        return $this->pays;
    }

    public function setPays($pays)
    {
        $this->pays = $pays;
    }

    public function getTelephoneP()
    {
        return $this->telephoneP;
    }

    public function setTelephoneP($telephoneP)
    {
        $this->telephoneP = $telephoneP;
    }

    public function getTelephoneS()
    {
        return $this->telephoneS;
    }

    public function setTelephoneS($telephoneS)
    {
        $this->telephoneS = $telephoneS;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getMailsecours()
    {
        return $this->mailsecours;
    }

    public function setMailsecours($mailsecours)
    {
        $this->mailsecours = $mailsecours;
    }

    public function getFacebook()
    {
        return $this->facebook;
    }

    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    public function getGoogleplus()
    {
        return $this->googleplus;
    }

    public function setGoogleplus($googleplus)
    {
        $this->googleplus = $googleplus;
    }

    public function getTwitter()
    {
        return $this->twitter;
    }

    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    public function getSkype()
    {
        return $this->skype;
    }

    public function setSkype($skype)
    {
        $this->skype = $skype;
    }

    public function getViadeo()
    {
        return $this->viadeo;
    }

    public function setViadeo($viadeo)
    {
        $this->viadeo = $viadeo;
    }

    public function getLinkedin()
    {
        return $this->linkedin;
    }

    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
    }



    /** Fonction qui permet de tester les expressions
     * 
     * @param \Symfony\Component\Validator\ExecutionContext $context
     */


    /*  public function NomValid(
     *    ExecutionContext $context) {

         if (
     *    preg_match_all(
     *    "#(
     *    .)\\1{2}#",
     *     $this->getNom())){

                $context->addViolationAtSubPath(
     *    'nom',
     *     'Erreur sur le texte');

        }
    }*/

}

