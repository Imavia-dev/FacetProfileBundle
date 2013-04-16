<?php
namespace Imavia\FacetProfileBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */

class AllowedCharactersValidator extends ConstraintValidator
{
    private $pattern;

    public function validate($value, Constraint $constraint)
    {
        $specialChars = explode('|', $constraint->specialChars);

        $this->pattern = "#";

        // Dans le cas ou seul les lettres sont autorisées
        if ($constraint->allowLetters == true && $constraint->allowNumbers == false) {
            $this->pattern = $this->pattern ."[^a-zA-Z éàôîâèëöïüùç";
            $this->manageSpecialChar($specialChars);
        }

          // Dans le cas ou seul les chiffres sont autorisées
        if ($constraint->allowLetters == false && $constraint->allowNumbers == true) {
             $this->pattern = $this->pattern ."[^0-9";
             $this->manageSpecialChar($specialChars);
        }
         // Dans le cas ou les lettres et les chiffres sont autorisées
        if ($constraint->allowLetters == true && $constraint->allowNumbers == true) {
            $this->pattern = $this->pattern ."[^a-zA-Z éàôîâèëöïüùç0-9";
            $this->manageSpecialChar($specialChars);
        }

        if ($constraint->allowLetters == false && $constraint->allowNumbers == false) {
            $this->pattern = $this->pattern . "#";

        } else {
            $this->pattern = $this->pattern . "]";

            // on retranche 1 à cause du retour en arrière de la regex (\1)

            if (($constraint->maxRepeatedchars) - 1 > 0) {
                $this->pattern = $this->pattern . "|(.)\\1{".$constraint->maxRepeatedchars."}#";
            } else {
                $this->pattern = $this->pattern."#";
            }
        }

        if (preg_match_all($this->pattern, $value)) {

                $this->context->addViolation($constraint->message);
        }
    }

    public function manageSpecialChar($specialChars)
    {
        if (count($specialChars) > 0) {
            foreach ($specialChars as $specialChar) {
                if (is_numeric($specialChar) == false) {
                    $this->pattern = $this->pattern . $specialChar;
                }
            }
        }
    }
}
