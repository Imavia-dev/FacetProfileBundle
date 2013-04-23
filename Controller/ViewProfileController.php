<?php

namespace Imavia\FacetProfileBundle\Controller;

// <editor-fold defaultstate="collapsed" desc="Inclusion ">
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Doctrine\ORM\Query\ResultSetMappingBuilder;

use Imavia\FacetProfileBundle\Entity\Profile;
use Imavia\FacetProfileBundle\Entity\Facet;
use Imavia\FacetProfileBundle\Entity\Component;
use Imavia\FacetProfileBundle\Entity\Attribute;
use Imavia\FacetProfileBundle\Entity\AttributeValue;
use \Imavia\FacetProfileBundle\ProfileModel\AttributeModel;
use \Imavia\FacetProfileBundle\ProfileModel;
use \Imavia\FacetProfileBundle\Form\ProfileCreationType;

use Imavia\FacetProfileBundle\Tools\DebugClass;

//</editor-fold>

class ViewProfileController extends Controller
{
    private $document ;
    private $attributes ;

    public function __construct()
    {
        $this->document = new \DOMDocument();
        $this->debug = new DebugClass();
        $this->debug->setAfficheDebug(false);

    }

    // <editor-fold defaultstate="collapsed" desc="Methode du Controller ">

    /** methode de la route "imavaia_view qui permet d'acceder à la visualisation
     * des profils
     * @author JV SF
     * 
     */

    public function initializeAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $sqlInValue = '';
        $i = 0;
        $p = 0;
        $searchMatrice = array();

        $profiles = $em
                ->getRepository('ImaviaFacetProfileBundle:Profile')
                ->findAll('');

        foreach ($profiles as $profile) {

            $facets = $em
                    ->getRepository('ImaviaFacetProfileBundle:Facet')
                    ->findById($profile->getId(), 'Informations Personelles');

            foreach ($facets as $facet) {
                $sqlInValue[$i] = $facet->getId();
                $i++;
            }

            $name = 'Identite';
            $sql = "SELECT c 
               FROM Imavia\FacetProfileBundle\Entity\Component c
               WHERE c.name='" . $name . "'"  ;

            if (count($sqlInValue) > 1) {
                $sql = $sql . " AND c.facet IN (" . implode(',', $sqlInValue) . ")";
            } else {
                $sql = $sql . " AND c.facet=" . $sqlInValue[0] ;
            }

            $comps = $em->createQuery($sql)->getResult();
            $i = 0;

            $sqlInValue = array();
            foreach ($comps as $comp) {
                $sqlInValue[$i] = $comp->getId();
                $i++;
            }

            $attributes = $em
                    ->getRepository('ImaviaFacetProfileBundle:Attribute')
                    ->findByComponent($sqlInValue);
            $i = 0;

            foreach ($attributes as $attribute) {
                $value = new AttributeValue;
                $sqlInValue[$i] = $attribute->getId();
                $i++;

                $attrValue['profile'] = $profile->getId();

                switch ($attribute->getName()) {

                    Case 'civilite' :
                        $value = $this->getValueFromAttribute($attribute);
                        $attrValue['civilite'] = $value->getValue();
                        break;

                    Case 'nom' :
                        $value = $this->getValueFromAttribute($attribute);
                        $attrValue['nom'] = $value->getValue();
                        break;

                    Case 'prenom' :
                        $value = $this->getValueFromAttribute($attribute);
                        $attrValue['prenom'] = $value->getValue();
                        break;

                    Case 'ddn' :
                        $value = $this->getValueFromAttribute($attribute);
                        $attrValue['ddn'] = $value->getValue();
                        break;

                    Case 'photo' :
                        $value = $this->getValueFromAttribute($attribute);

                        if (is_object($value) == true) {
                            $attrValue['photo'] = $value->getValue();
                        } else {
                             $attrValue['photo'] = '../default.png';
                        }

                        break;
                }
            }
              $searchMatrice[$p] = $attrValue ;
              $p++;
       }

        return $this->render(
            'ImaviaFacetProfileBundle::ViewProfile.html.twig',
            Array('profiles' => $searchMatrice)
        );
    }

    /** methode de la route "imavaia_add qui permet d'ajouter un nouveau 
     * profile
     * 
     * @author JV SF
     * 
     */
    public function addAction()
    {

        /* Attribute Model représente la Classe contenant tous les attributs
         * à creer lors de la création d'un profil
         */
        $request = $this->get('request');

        $attributeM = new AttributeModel();
        $form = $this->createForm(new ProfileCreationType, $attributeM);

        $response = new Response();

        if ($request->getMethod() == 'POST') {
               $form->bind($request);
            if ($form->isValid()) {

                $path = $this->get('kernel')
                            ->getBundle('ImaviaFacetProfileBundle')
                            ->getPath();
                //Pour traiter le cas il n'y a pas de photos à uploader
                if ($form['photo']->getData() != null) {
                    $newimageName = $this->handlePhoto($form);
                    if (strlen($newimageName) > 0) {
                        $attributeM->setPhoto($newimageName);
                    }
                }

                $this->CreateProfileFromModel($path . '/ProfileModel/ProfileModel.xml');
                foreach ($this->attributes as $attribute) {
                    // Reupéperer dans un Tableau par reflexion les propriètés
                    // de la classe AttributeModel
                    $reflection = new \ReflectionClass($attributeM);
                    $proprietes   = $reflection->getProperties();

                    // Pour chaque proprièté verifier qu'il existe une egalité
                    // avec le nom des attributs
                    foreach ($proprietes as $propriete) {
                        if ($propriete->getName() == $attribute->getName()) {
                            // En cas D'egalité creer une attributevalue
                            // directement reliée à l'attribut par son ID
                            $valeur = $this->instantiateElement("valeur");
                            // Creation du descripteur de la valeur
                            $descriptor = $this
                            ->createValueDescriptor($attribute, $attributeM);
                            // Faire persister cette valeur dans la base de donnée
                            if (isset($descriptor['valeur'])) {
                                $this
                                ->createElementProfile(
                                    $descriptor,
                                    $valeur,
                                    $attribute,
                                    "valeur"
                                );
                            }
                            break;
                        }
                    }
                }
                $response->setContent('Formulaire Valide');

                return $response;

            } else {

                return $this->render(
                    'ImaviaFacetProfileBundle::AddProfile.html.twig',
                    array('form' => $form->createView())
                );

           }

        } else {
            return $this->render(
                'ImaviaFacetProfileBundle::AddProfile.html.twig',
                array('form' => $form->createView())
            );
        }
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Outils Photos ">

     /*
     * Gestion de l'upload de photo
     * @author JV SF
     */
    public function handlePhoto($form)
    {

        // On tranforme un nombre pris au hasard entre 1 et 1 000 000
        // en hexadecimal
        $hexnbr = $this->decToHex(\rand(1, 1000000));

        // On tranforme le texte du pseudo unique et obligatoire
        // en hexadecimal
        $hexpseudo = $this->strToHex($form['pseudo']->getData());

        // On recupere le chemin ou sont stockés les images des profiles
        // Pour l'instant dans le repertoire Userimages à discuter ultérieurement
        $cheminPhoto = $this->get('kernel')->getRootDir() .
            '/../web/bundles/imaviafacetprofile/images/userimages/';

        //Copie de la Photo pour retraitement futur en fonction de son type Mime
        // PNG ou JPEG
        $uploadedImage = $this->initializeImage($form);

        if ($uploadedImage != null) {
            //recuperation de la taille actuelle de l'image
            $imageWorkingCopySize = getimagesize($form['photo']->getData());

            $imageLayer = $this->resizeImage(
                $uploadedImage,
                $imageWorkingCopySize
            );

            $imageName = $this->saveImage(
                $imageLayer,
                $form['photo']->getData()->getMimeType(),
                $hexnbr . $hexpseudo,
                $cheminPhoto,
                100
            );
        }
        //Retour du nom de la nouvelle image créee
        return  $imageName ;

    }
    /**
     * Transformation d'un text en hexadecimal
     * @param type $texte le texte à tranformer en hexa
     * @return $hex La chaine transformée en hexadécimale
     */

    public function strToHex($texte)
    {
        $hex = '';
        $longueurChaine = strlen($texte);
        for ($i = 0; $i < $longueurChaine; $i++) {
            $hex .= dechex(ord($texte[$i]));
        }

        return $hex;
    }

    /**
     * Transformation d'un nombre en hexadecimal
     * @param int $nombre le texte à tranformer en hexa
     * @return $hex La chaine transformée en hexadécimale
     */
    public function decToHex($nombre)
    {
        $hex = dechex($nombre);

        return $hex;
    }

    /* Fonction pour creer une copie de l'image uploader en vue
    * d'un retraitement
    * @param form : Correspondant au formulaire posté lors du submit
    * @return Image : Image representant une copie en memeoire du fichier
    * uploadé en fonction de son type mime
    */

    public function initializeImage($form)
    {

        switch ($form['photo']->getData()->getMimeType()) {
            //JPEG
            Case "image/jpeg" :
                   $uploadedImage = imagecreatefromjpeg($form['photo']->getData());
            break;

            // JPEG : Pour internet explorer qui retourne un mauvais mime type
            Case "image/pjpeg" :
                   $uploadedImage = imagecreatefromjpeg($form['photo']->getData());
            break;

            //PNG
            Case "image/png" :
                  $uploadedImage = imagecreatefrompng($form['photo']->getData());
            break;
            // PNG Internet explorer tous pourri
            Case "image/x-png" :
                  $uploadedImage = imagecreatefrompng($form['photo']->getData());
            break;

            default:
                 $uploadedImage = null;
        }

        return $uploadedImage;

    }

     /**
     * Fonction qui calcule le coefficient de redimentionnement de l'image en
     * fonction de son sens
     * 
     * @param $imageWorkingCopy : Copie de l'image uploadé 
     * @return Un calque de l'image redimensionné
     */


    public function resizeImage($imageWorkingCopy, $imageWorkingCopySize)
    {
        $size = $this
               ->calculateRatio(
                   $imageWorkingCopySize[0],
                   $imageWorkingCopySize[1]
               );

        $imageLayer = imagecreatetruecolor($size['Largeur'], $size['Hauteur']);

        imagealphablending($imageLayer, false);
        imagesavealpha($imageLayer, true);
        $white = imagecolorallocate($imageLayer, 255, 255, 255);
        imagefill($imageLayer, 0, 0, $white);
        imagecolortransparent($imageLayer, $white);

        imagecopyresampled(
            $imageLayer,
            $imageWorkingCopy,
            0, 0, 0, 0,
            $size['Largeur'],
            $size['Hauteur'],
            $imageWorkingCopySize[0],
            $imageWorkingCopySize[1]
        );

        // Renommage et deplacement dans le web public
        // Nom de l'image : concatenation des pseudo et nombre en transformés
        // en hexadecimal

        return $imageLayer;
   }

     /**
    * Fonction Permettant de sauvegarder le fichier image retraité
    * @param  $imageToSave : Imave a sauver
    * @param  $mimeType : Type Mime du Fichier Uploadé
    * @param  $fileName : Nom du fichier sans extension
    * @param  $location : Chemin où l'on dpoit enregistré l'image
    * @param  $quality : Qualité de l'enregistrement 
    */
    public function saveImage($imageToSave, $mimeType, $fileName, $location, $quality)
    {

        switch ($mimeType) {
            //JPEG
            Case "image/jpeg" :
                imagejpeg($imageToSave, $location.$fileName . '.jpeg', $quality);
                $ext = '.jpeg';
            break;

            // JPEG : Pour internet explorer qui retourne un mauvais mime type
            Case "image/pjpeg" :
                imagejpeg($imageToSave, $location.$fileName . '.jpeg', $quality);
                $ext = '.jpeg';
            break;

            //PNG
            Case "image/png" :
                imagepng($imageToSave, $location.$fileName . '.png');
                $ext = '.png';
            break;
            // PNG  Pour internet explorer qui retourne un mauvais mime type
            Case "image/x-png" :
                imagepng($imageToSave, $location.$fileName . '.png');
                $ext = '.png';
            break;

        }
         // echo("Nom de l'image de la fonction Save image" .$fileName.$ext );
         return $fileName.$ext ;
   }

    /**
     * Fonction pour calculer le ratio de redimentionnement de l'image 
     * @param int $width : Hauteur de l'image actuelle
     * @param int $height : Largeur de l'image actuelle 
     * @return int tableau associatif avec Hauteur et largeur redimentionnée
     */
    public function calculateRatio($width,$height)
    {
        if ($width <= $height) {
            $wantedWidth = 75;
            $wantedHeight = (($height * ($wantedWidth * 100) / $width) / 100);
        } else if ($width > $height) {
            $wantedHeight = 100;
            $wantedWidth  = (($width * ($wantedHeight * 100) / $height) / 100);
        }
        $size = array(
               'Hauteur' => $wantedHeight,
               'Largeur' => $wantedWidth

        );

        return $size;
       }
     //</editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Outils Creation Profile ">


    public function getValueFromAttribute ($attribute)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $values = $em->getRepository('ImaviaFacetProfileBundle:AttributeValue')
                ->findByAttribute($attribute->getId());

        if (count($values) == 0) {
            return '';
        } else {
            return $values[0];
        }
    }

    /**
     * Fonction Permettant la création d'un descripteur de Valeur
     * 
     * @param $ParentElement : Attribut sur lequel est greffé la valeur 
     * @param $modelClassvalue : Reflexion class pour executer la methode get +
     * le nom de l'attribut 
     * @return $descriptor : Tableau contenant un descriptif d'une valeur 
     * d'attribut
     * @author JV SF 
     */
    public function createValueDescriptor($attributeElement,$modelClassValue)
    {
        $descriptor = array() ;

            $getMethod = 'get' . ucfirst($attributeElement->getName());
            $valeur = $modelClassValue->{$getMethod}();
            $dateeval = new \DateTime();
        if (isset($valeur)) {
                    $descriptor['valeur'] = $valeur;
                    $descriptor['dateEval'] = $dateeval;
            }

        return $descriptor;
    }

    /**
     * Fonction Permettant la création d'un descripteur d'un element de profile
     * @param $xmlNode : Noeud Parent au descripteur 
     * @return $descriptor : Tableau contenant un descriptif d'un element du
     * profile
     * @author JV SF 
     */

    public function createElementDescriptor($xmlNode)
    {
        $descriptor = array() ;

        $tab = array('nom', 'description');

            //$this->debug->echoDebug("est dans la première boucle");

        foreach ($tab as $ligne) {
            //$this->debug->echoDebug("est dans la deuxiemme boucle");
            $valeur = $xmlNode->getAttribute($ligne);
            $descriptor[$ligne] = $valeur;
        }

        return $descriptor;
    }

    /** Creer un profil depuis un fichier xml de modèle
    * Fonction qui peremet de creer les Facets Components et Attribute d'un profil
    * Automatiquement depuis un fichier XMl
    * @param string $url Url de location du modele de profile
    */
    public function createProfileFromModel($url)
    {
        //TODO Create Xml Schema
        //TODO Check XML Schema compliance
         $this->document->load($url);
         $domX = new \DOMXPath($this->document);

        if (strlen($url) > 0) {
            // Creation d'un Profile //
            $em = $this->container->get('doctrine.orm.entity_manager');
            $profile = new Profile();
            $em->persist($profile);
            $parentElement = $profile;
            $em->flush($profile);

            // Verification du format de l'URL

            if (strcmp('.xml', substr($url, strlen($url - 4)))) {
                // Chargement du Fichier XML dans un Dom Document

                $this->debug->echoDebug("Chargement du fichier xml " . "<BR>");

                $xmlNodes = $domX->query("facette");
                $this->createFacet($xmlNodes, $parentElement);
           }
        }
    }

    /**
     * Creation d'une Facette
     * @param xmlNodes $xmlNodes : Tableau des Facettes à creéé
     * @param type $parentElement : Element Parent à la facette (Ici un Profile)
     * @author JV SF 
     */

    public function createFacet ($xmlNodes, $parentElement)
    {
        foreach ($xmlNodes as $xmlNode) {
            $profileElement = $this->instantiateElement("facette");
            $profileDescriptor = $this->createElementDescriptor($xmlNode);
            $facette = $this->createElementProfile(
                $profileDescriptor, $profileElement, $parentElement, 'facette'
            );
            // Recupération des enfants de la facette s'il y a lieu
            // (donc par deduction que des composants
            $this->createComponent($xmlNode->childNodes, $facette);
        }
    }

    /**
     * Creation des Composants
     * @param type $xmlNodes Tableau des composants à creer
     * @param type $parentElement Element Parent aux composants (Ici la facette)
     * ou un autre composant
     */
    public function createComponent($xmlNodes, $parentElement)
    {
        $type = '';
        foreach ($xmlNodes as $xmlNode) {
            if ($xmlNode->nodeName != "#text") {
                if ($xmlNode->nodeName == 'composant') {
                    $type = 'composant';
                } else if ($xmlNode->nodeName == 'souscomposant') {
                    $type = 'souscomposant';
                    }

                if ($type != '') {
                    $profileElement = $this->instantiateElement($type);
                    $profileDescriptor = $this->createElementDescriptor($xmlNode);
                    $composant = $this->createElementProfile(
                        $profileDescriptor,
                        $profileElement,
                        $parentElement,
                        $type
                    );
                    $this->createAttribute($xmlNode->childNodes, $composant);
                    $this->createComponent($xmlNode->childNodes, $composant);

                }
            }
        }
    }
        /**
         * Creation des Attriburts
         * @param type $xmlNodes Tableau des attributs à creer
         * @param type $parentElement
         */
    public function createAttribute($xmlNodes, $parentElement)
    {
        foreach ($xmlNodes as $xmlNode) {
            if ($xmlNode->nodeName == 'attribut') {
                $profileElement = $this->instantiateElement("attribut");
                $profileDescriptor = $this->createElementDescriptor($xmlNode);
                $attribut = $this->createElementProfile(
                    $profileDescriptor,
                    $profileElement,
                    $parentElement,
                    'attribut'
                );
                $this->attributes[] = $attribut;
            }
        }
    }

    private function instantiateElement($elementType)
    {

        switch ($elementType)
        {
            case 'facette':
                $element = new facet();
                break;

            Case 'composant' :
                $element = new Component();
                break;

            Case 'souscomposant' :
                $element = new Component();
                break;

            Case 'attribut' :
                $element = new Attribute();
                break;

            Case 'valeur' :
                $element = new AttributeValue();
                break;
        }

        return $element;
    }

    public function createElementProfile($elementDescriptors,$element , $elementParent,$elementType)
    {

        //$element = $this->InstatiateElement($elementType);

        $em = $this->container->get('doctrine.orm.entity_manager');

        if (isset($elementDescriptors['nom'])) {
            $element->setName($elementDescriptors['nom']);
        }

        if (isset($elementDescriptors['description'])) {
            $element->setDescription($elementDescriptors['description']);
        }

        $element->setCreationDate(new \DateTime());
        $element->setLastModificationDate(new \DateTime());

        switch ($elementType) {
            case 'facette' :
                $element->SetProfile($elementParent->getId());
            break;

            Case 'composant' :
                $element->SetFacet($elementParent->getId());
            break ;

            Case 'souscomposant' :
                $element->SetFacet($elementParent->getFacet());
                $element->SetParent($elementParent);
            break ;

            Case 'attribut' :
                $element->SetComponent($elementParent->getId());
            break ;

            Case 'valeur' :
                $element->SetAttribute($elementParent->getId());

                if (is_string($elementDescriptors['valeur']) == true) {
                    $valeur = $elementDescriptors['valeur'];
                    $element->SetValue($valeur);
                }

                if (is_object($elementDescriptors['valeur']) == true) {
                    $objectValue = ($elementDescriptors['valeur']);
                    $className = get_class($objectValue);

                    switch ($className) {
                        case 'DateTime':
                            $valeur = date_format(
                                $elementDescriptors['valeur'], 'd/m/Y'
                            );
                            $element->SetValue($valeur);
                        break;

                        case 'Symfony\Component\HttpFoundation\File\UploadedFile':
                            $valeur = $elementDescriptors['valeur'];
                            $element->SetValue($valeur);
                        break;
                  }
               }
                if (isset($elementDescriptors['dateEval'])) {
                    $element->SetEvaluationDate($elementDescriptors['dateEval']);
                }
                if (isset($elementDescriptors['scaleId'])) {
                    $element->SetScale($elementDescriptors['scaleId']);
                }

            break ;

       }
        $em->persist($element);
        $em->flush($element);

        return $element ;
    }
      // </editor-fold >
}
