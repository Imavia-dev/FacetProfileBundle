<?php
namespace Imavia\FacetProfileBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */

class AllowedCharacters extends Constraint
{
    /**
     * Lettres Autorisées
     */

    public $allowLetters = true;

    /**
     * Nombre Autorisées
     */

    public $allowNumbers = true;

    /**
     * Tableau des caratères spéciaux autorisées
     */
    public $specialChars;

    /*
     * Nombre de repetition autorisées pour chaque caractère contigu
     */
    public $maxRepeatedchars = 2 ;

    /**
     * message d'erreur personalisé 
     */
    public $message = "Erreur ce champ est invalide" ;

}
