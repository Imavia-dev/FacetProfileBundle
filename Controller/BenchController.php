<?php

namespace Imavia\FacetProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Imavia\FacetProfileBundle\Entity\Profile;
use Imavia\FacetProfileBundle\Entity\Facet;
use Imavia\FacetProfileBundle\Entity\Component;
use Imavia\FacetProfileBundle\Entity\Attribute;
use Imavia\FacetProfileBundle\Entity\AttributeValue;
use Imavia\FacetProfileBundle\Tools\DebugClass;

class BenchController extends Controller
{

     private $tab;

     /**
      *
      * @Route("/bench", name="imavia_bench")
      * @Template()
     */
    public function indexAction()
    {
        $this->createProfile();

        return $this->render('ImaviaFacetProfileBundle::HelloWorld.html.twig');
    }

    public function getComponent($components)
    {
        $debug = new DebugClass();
        $debug->setAfficheDebug(false);

        $repositoryC = $this->container->get('doctrine.orm.entity_manager')
                ->getRepository('ImaviaFacetProfileBundle:Component');
        $repositoryA = $this->container->get('doctrine.orm.entity_manager')
                ->getRepository('ImaviaFacetProfileBundle:Attribute');

        foreach ($components as $component) {
            if (count($repositoryA->findByComponent($component->getId())) > 0) {
                $attributes = $repositoryA->findByComponent($component->getId());
                $this->getAttribute($attributes);
            }
            if ($component->getLevel() == 0) {
                $debug->echoDebug(
                    "Composant n° " . $component->getId() . " : " .
                    $component->getName() . "<BR>" .
                    $component->getDescription() . "<BR>"
                );
            } else {
                $debug->echoDebug(
                    "Souscomposant du composant n° " . $component->getParent()
                    ->getId() . " n° " . $component->getId() . " : " .
                    $component->getName() . "<BR>" . $component->getDescription()
                    . "<BR>"
                );
            }
            // on teste s'il existe des sous composants
        }
        if (count($repositoryC->findByParent($component->getId())) > 0) {
            $subcomponents = $repositoryC->findByParent($component->getId());
            $this->getComponent($subcomponents);
        }
    }

    public function getAttribute($attributes)
    {
        $debug = new DebugClass();
        $debug->setAfficheDebug(false);
        $repositoryAV = $this->container->get('doctrine.orm.entity_manager')
                ->getRepository('ImaviaFacetProfileBundle:AttributeValue');
        foreach ($attributes as $attribute) {
            $debug->echoDebug(
                "Attribut n° " . $attribute->getId() . " : " .
                $attribute->getName() . "<BR>" .
                $attribute->getDescription() . "<BR>"
            );
            if (count($repositoryAV->findByAttribute($attribute->getId()) > 0)) {
                $values = $repositoryAV->findByAttribute($attribute->getId());
                $this->getValue($values);
                // print_r($this->tab);
            }
        }
    }

    public function getValue($values)
    {
        $repositoryA = $this->container->get('doctrine.orm.entity_manager')
                ->getRepository('ImaviaFacetProfileBundle:Attribute');
        $debug = new DebugClass();
        $debug->setAfficheDebug(true);
        foreach ($values as $value) {
            //$debug->echoDebug("Valeur : " . $value->GetAttribute(). "<BR>");
            $attributes = $repositoryA->findById($value->GetAttribute());

            foreach ($attributes as $att) {

                $name = $att->getName();

                switch ($name) {
                    case 'Nom' :
                        $nom = 'nom';
                        break;

                    case 'Prénom' :
                        $nom = 'prenom';
                        break;

                    case 'Date de naissance' :
                        $nom = 'ddn';
                        break;

                    case 'Photo' :
                        $nom = 'photo';
                        break;

                    default :
                        $nom = $name;
                        break;
                }

                $this->tab[$nom] = $value->getValue();
            }
        }
    }

    public function createElementProfile($elementDescriptors, $idElementParent, $elementType)
    {

        switch ($elementType) {
            case 1:
                $element = new facet();
                break;

            Case 2 :
                $element = new Component();
                break;

            Case 3 :
                $element = new Component();
                break;

            Case 4 :
                $element = new Attribute();
                break;

            Case 5 :
                $element = new AttributeValue();
                break;
        }

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
            case 1:
                $element->SetProfile($idElementParent);
                break;

            Case 2 :
                $element->SetFacet($idElementParent);
                break;

            Case 3 :
                $element->SetFacet($idElementParent);
                $element->SetParent($elementDescriptors['Parent']);
                break;

            Case 4 :
                $element->SetComponent($idElementParent);
                break;

            Case 5 :
                $element->SetAttribute($idElementParent);
                $element->SetValue($elementDescriptors['Valeur']);
                if (isset($elementDescriptors['DateEval'])) {
                    $element->SetEvaluationDate($elementDescriptors['DateEval']);
                }
                if (isset($elementDescriptors['ScaleId'])) {
                    $element->SetScale($elementDescriptors['ScaleId']);
                }

                break;
        }
        $em->persist($element);
        $em->flush($element);

        return $element;
    }

    public function createProfile()
    {

        $em = $this->container->get('doctrine.orm.entity_manager');

        $this->tab = array();
        $debug = new DebugClass();
        $debug->setAfficheDebug(false);

        $debug->echoDebug("********************Creation d'un Nouveau profil <BR>");
        $profile = new Profile();
        $em->persist($profile);
        $debug->echoDebug("********************Enregistrement du profil <BR>");
        $em->flush($profile);
        $debug->echoDebug("********************Profil creé sous l'ID N° " . $profile->getId() . " <BR>");

        $facet = $this->createElementProfile(
            array(
            'nom' => 'informations personelles',
            'description' => "Facette dédiée au recueil 
            des informations sur l'utilisateur"
            ), $profile->getId(), 1
        );

        $facet = $this->createElementProfile(
            array(
            'nom' => 'Apprentissage',
            'description' => "Apprentissage"
                ), $profile->getId(), 1
        );

        $component = $this->createElementProfile(
            array(
            'nom' => 'Identité',
            'description' => "Identité de l'utilisateur"
            ), $facet->getId(), 2
        );

        $subcomponent = $this->createElementProfile(
            array(
            'nom' => 'Test',
            'description' => "Test Sous composant",
            'Parent' => $component,
            ), $facet->getId(), 3
        );

        $attribute = $this->createElementProfile(
            array(
            'nom' => 'Nom',
            'description' => "Nom de l'utilisateur"
            ), $component->getId(), 4
        );

        $value = $this->createElementProfile(
            array(
            'Valeur' => "Varini",
            ), $attribute->getId(), 5
        );

        $attribute = $this->createElementProfile(
            array(
            'nom' => 'Prénom',
            'description' => "Prénom de l'utilisateur"
            ), $component->getId(), 4
        );

        $value = $this->createElementProfile(
            array('Valeur' => "Jérôme"), $attribute->getId(), 5
        );

        $attribute = $this->createElementProfile(
            array(
            'nom' => 'Date de naissance',
            'description' => "Date de naissance de l'utilisateur"
            ), $component->getId(), 4
        );

        $value = $this->createElementProfile(
            array('Valeur' => "04/11/1975"), $attribute->getId(), 5
        );

        $attribute = $this->createElementProfile(
            array(
            'nom' => 'Adresse Electronique',
            'description' => "Courriel de l'utilisateur"
           ), $component->getId(), 4
        );

        $value = $this->createElementProfile(
            array('Valeur' => "jerome.varini@imavia.fr"), $attribute->getId(), 5
        );

        $attribute = $this->createElementProfile(
            array(
            'nom' => 'Photo',
            'description' => "Photo de l'utilisateur"
            ), $component->getId(), 4
        );

        $value = $this->createElementProfile(
            array('Valeur' => "default.png"), $attribute->getId(), 5
        );

        $repositoryP = $this->container->get('doctrine.orm.entity_manager')
                ->getRepository('ImaviaFacetProfileBundle:Profile');
        $repositoryF = $this->container->get('doctrine.orm.entity_manager')
                ->getRepository('ImaviaFacetProfileBundle:Facet');
        $repositoryC = $this->container->get('doctrine.orm.entity_manager')
                ->getRepository('ImaviaFacetProfileBundle:Component');

        $listprofiles = $repositoryP->findAll();

        foreach ($listprofiles as $profile) {
            $listfacets = $repositoryF->GetFacetByName(array('Informations personelles'), $profile->getId());
            foreach ($listfacets as $facet) {
                $listecomposants = $repositoryC->findByName(array('Identité', $facet->getId()));
            }
            if (count($listecomposants) > 0) {
                $this->getComponent($listecomposants);
            }
        }
        print_r($this->tab);
    }
}
