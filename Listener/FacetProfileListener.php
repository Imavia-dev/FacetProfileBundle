<?php

/**
 * Imavia Bundle Object AttributeValue
 *    
 * @author Jerome Varini <jerome.varini@imavia.fr>
 * @author Fricker Sebastien <sebastien.fricker@imavia.fr>
 * @link   http://www.imavia.fr Site web Imavia
 * 
 */

namespace Imavia\FacetProfileBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerAware;
use Claroline\CoreBundle\Library\Event\DisplayToolEvent;
use \Imavia\FacetProfileBundle\Entity\Profile;
use Imavia\FacetProfileBundle\Entity\Facet;
use \Imavia\FacetProfileBundle\Entity\Component;
use \Imavia\FacetProfileBundle\Entity\Attribute;
use \Imavia\FacetProfileBundle\Entity\AttributeValue;
use \Imavia\FacetProfileBundle\Entity\Scale;
use Imavia\FacetProfileBundle\Entity\UserComment;
use Imavia\FacetProfileBundle\Tools\DebugClass;
/**
 * Listener Profile Bundle
 */
class FacetProfileListener extends ContainerAware
{

    /**
     * fonction Apppele par le listeners 
     * 
     * @param \Claroline\CoreBundle\Library\Event\DisplayToolEvent $event 
     * Evenement declenché par le bureau claroline 
     * 
     * @return none 
     */
    public function onStartUp(DisplayToolEvent $event)
    {
        $debug = new DebugClass();
        $debug->setAfficheDebug(false);

        $em = $this->container->get('doctrine.orm.entity_manager');

        $debug->echoDebug("********************Creation d'un Nouveau profil <BR>");
        $profile = new Profile();
        $em->persist($profile);
        $debug->echoDebug("********************Enregistrement du profil <BR>");
        $em->flush($profile);
        $debug->echoDebug("********************Profil creé sous l'ID N° " . $profile->getId() . " <BR>");
        $debug->echoDebug("********************Creation d'une nouvelle facette <BR>");
        $facet = new Facet();

        $facet->setName('Informations personelles');
        $facet->setDescription("Facette Dediée au recueil des informations sur l'utilisateur");
        $facet->setCreationDate(new \DateTime());
        $facet->setLastModificationDate(new \DateTime());
        $facet->setProfile($profile->getId());

        $em->persist($facet);
        $debug->echoDebug("********************Enregistrement de la facette <BR>");
        $em->flush($facet);
        $debug->echoDebug(
            "********************Facette : " . $facet->getName() .
            " enregistrée sous l'ID N° " . $facet->getId() . "<BR>"
        );

        $debug->echoDebug("********************Creation d'une nouvelle facette <BR>");
        $facetb = new Facet();
        $facetb->setName('Apprentissage');
        $facetb->setDescription("Parcours de l'apprenant sur la plateforme");
        $facetb->setCreationDate(new \DateTime());
        $facetb->setLastModificationDate(new \DateTime());
        $facetb->setProfile($profile->getId());

        $em->persist($facetb);
        $debug->echoDebug("********************Enregistrement de la facette <BR>");
        $em->flush($facetb);
        $debug->echoDebug(
            "********************Facette : " . $facetb->getName() .
            " enregistrée sous l'ID N° " . $facetb->getId() . "<BR>"
        );

        $debug->echoDebug("********************Creation d'un nouveau Composant <BR>");
        $component = new Component();
        $component->setName('Identité');
        $component->setDescription("Information concernant l'identité de l'utilisateur");
        $component->setCreationDate(new \DateTime());
        $component->setLastModificationDate(new \DateTime());
        $component->setFacet($facet->getId());
        //$component->setParent($component);
        //$component->setRoot($component);
        //$component->setLevel(0);
        $em->persist($component);
        $debug->echoDebug("********************Enregistrement du component <BR>");
        $em->flush($component);
        $debug->echoDebug(
            "********************Composant : " .
            $component->getName() . " enregistrée sous l'ID N° "
            . $component->getId() . "<BR>"
        );

        $debug->echoDebug("********************Creation d'un nouvel attribut <BR>");

        $attribute = new Attribute();

        $attribute->setName('Nom');
        $attribute->setDescription("Nom de l'utilisateur");
        $attribute->setCreationDate(new \DateTime());
        $attribute->setLastModificationDate(new \DateTime());
        $attribute->setComponent($component->getId());

        $em->persist($attribute);
        $debug->echoDebug("********************Enregistrement de l'attribut <BR>");
        $em->flush($attribute);
        $debug->echoDebug(
            "********************Attribut : " . $attribute->getName()
            . " enregistrée sous l'ID N° " . $attribute->getId() . "<BR>"
        );

        $debug->echoDebug("********************Creation d'une nouvelle valeur d'attribut <BR>");
        $attributeValue = new AttributeValue();

        $attributeValue->setValue('Varini');
        $attributeValue->setLastModificationDate(new \DateTime());
        $attributeValue->setCreationDate(new \DateTime());
        $attributeValue->setAttribute($attribute->getId());
        $debug->echoDebug("********************Enregistrement de la valeur pour l'attribut <BR>");
        $em->persist($attributeValue);
        $debug->echoDebug(
            "********************Valeur : " . $attributeValue->getValue() .
            " enregistrée <BR>"
        );
        $em->flush($attributeValue);

        $attribute = new Attribute();

        $attribute->setName('Prénom');
        $attribute->setDescription("Prénom de l'utilisateur");
        $attribute->setCreationDate(new \DateTime());
        $attribute->setLastModificationDate(new \DateTime());
        $attribute->setComponent($component->getId());

        $em->persist($attribute);
        $debug->echoDebug("********************Enregistrement de l'attribut <BR>");
        $em->flush($attribute);
        $debug->echoDebug(
            "********************Attribut : " . $attribute->getName() .
            " enregistrée sous l'ID N° " . $attribute->getId() . "<BR>"
        );

        $debug->echoDebug("********************Creation d'une nouvelle valeur d'attribut <BR>");
        $attributeValue = new AttributeValue();

        $attributeValue->setValue('Jérôme');
        $attributeValue->setLastModificationDate(new \DateTime());
        $attributeValue->setCreationDate(new \DateTime());
        $attributeValue->setAttribute($attribute->getId());
        $debug->echoDebug("********************Enregistrement de la valeur pour l'attribut <BR>");
        $em->persist($attributeValue);
        $debug->echoDebug(
            "********************Valeur : " . $attributeValue->getValue()
            . " enregistrée <BR>"
        );
        $em->flush($attributeValue);

        $attribute = new Attribute();

        $attribute->setName('Date de naissance');
        $attribute->setDescription("Date de naissance de l'utilisateur");
        $attribute->setCreationDate(new \DateTime());
        $attribute->setLastModificationDate(new \DateTime());
        $attribute->setComponent($component->getId());

        $em->persist($attribute);
        $debug->echoDebug("********************Enregistrement de l'attribut <BR>");
        $em->flush($attribute);
        $debug->echoDebug(
            "********************Attribut : " . $attribute->getName() .
            " enregistrée sous l'ID N° " . $attribute->getId() . "<BR>"
        );

        $debug->echoDebug("********************Creation d'une nouvelle valeur d'attribut <BR>");
        $attributeValue = new AttributeValue();

        $attributeValue->setValue('04/11/1975');
        $attributeValue->setLastModificationDate(new \DateTime());
        $attributeValue->setCreationDate(new \DateTime());
        $attributeValue->setAttribute($attribute->getId());
        $debug->echoDebug("********************Enregistrement de la valeur pour l'attribut <BR>");
        $em->persist($attributeValue);
        $debug->echoDebug("********************Valeur : " . $attributeValue->getValue() . " enregistrée <BR>");
        $em->flush($attributeValue);

        $attribute = new Attribute();

        $attribute->setName('Adresse Electronique');
        $attribute->setDescription("Courriel de l'utilisateur");
        $attribute->setCreationDate(new \DateTime());
        $attribute->setLastModificationDate(new \DateTime());
        $attribute->setComponent($component->getId());

        $em->persist($attribute);
        $debug->echoDebug("********************Enregistrement de l'attribut <BR>");
        $em->flush($attribute);
        $debug->echoDebug(
            "********************Attribut : " . $attribute->getName() .
            " enregistrée sous l'ID N° " . $attribute->getId() . "<BR>"
        );

        $debug->echoDebug("********************Creation d'une nouvelle valeur d'attribut <BR>");

        $attributeValue = new AttributeValue();

        $attributeValue->setValue('jerome.varini@imavia.fr');
        $attributeValue->setLastModificationDate(new \DateTime());
        $attributeValue->setCreationDate(new \DateTime());
        $attributeValue->setAttribute($attribute->getId());
        $debug->echoDebug("********************Enregistrement de la valeur pour l'attribut <BR>");
        $em->persist($attributeValue);
        $debug->echoDebug(
            "********************Valeur : " . $attributeValue->getValue() .
            " enregistrée <BR>"
        );
        $em->flush($attributeValue);

        $attribute = new Attribute();

        $attribute->setName('Photo');
        $attribute->setDescription("Photo de l'utilisateur");
        $attribute->setCreationDate(new \DateTime());
        $attribute->setLastModificationDate(new \DateTime());
        $attribute->setComponent($component->getId());

        $em->persist($attribute);
        $debug->echoDebug("********************Enregistrement de l'attribut <BR>");
        $em->flush($attribute);
        $debug->echoDebug(
            "********************Attribut : " . $attribute->getName() .
            " enregistrée sous l'ID N° " . $attribute->getId() . "<BR>"
        );

        $attributeValue = new AttributeValue();

        $attributeValue->setValue('default.png');
        $attributeValue->setLastModificationDate(new \DateTime());
        $attributeValue->setCreationDate(new \DateTime());
        $attributeValue->setAttribute($attribute->getId());
        $debug->echoDebug("********************Enregistrement de la valeur pour l'attribut <BR>");
        $em->persist($attributeValue);
        $debug->echoDebug("********************Valeur : " . $attributeValue->getValue() . " enregistrée <BR>");
        $em->flush($attributeValue);

        $debug->setAfficheDebug(true);
        $debug->echoDebug("********************Phase de recupèration des données <BR>");

        $debug->echoDebug("********************Affichage des ID de profil enregistrés <BR>");

        $repositoryP = $this->container->get('doctrine.orm.entity_manager')
                ->getRepository('ImaviaFacetProfileBundle:Profile');
        $repositoryF = $this->container->get('doctrine.orm.entity_manager')
                ->getRepository('ImaviaFacetProfileBundle:Facet');
        $repositoryC = $this->container->get('doctrine.orm.entity_manager')
                ->getRepository('ImaviaFacetProfileBundle:Component');

        $debug->echoDebug("Récupération de tous les profils <BR>");

        $listprofiles = $repositoryP->findAll();

        foreach ($listprofiles as $profile) {

            $debug->echoDebug("Profils : <BR>" .$profile->getId(). "<BR>");
            $listfacets = $repositoryF->GetFacetByName(array('Informations personelles'), $profile->getId());
            foreach ($listfacets as $facet) {

                $debug->echoDebug(
                    "Facette n°".$facet->getId()." : "
                    .$facet->getName() . "<BR>" .$facet->getDescription(). "<BR>"
                );

                $listecomposants = $repositoryC->findByFacet($facet->getId());

                if (count($listecomposants) > 0) {
                     $this->getComponentChildren($listecomposants);
                }

            }
        }
        $twig = $this->container->get('templating');
        $vue = $twig->render('ImaviaFacetProfileBundle::HelloWorld.html.twig');
        $event->setContent($vue);
    }

    public function getComponentChildren( $components)
    {
        $debug = new DebugClass();
        $debug->setAfficheDebug(true);

        $repositoryC = $this->container->get('doctrine.orm.entity_manager')
        ->getRepository('ImaviaFacetProfileBundle:Component');

        foreach ($components as $component) {

            if ($component->getLevel() == 0) {
                $debug->echoDebug(
                    "Composant n° " . $component->getId() . " : " .
                    $component->getName() . "<BR>" .
                    $component->getDescription() . "<BR>"
                );
            } else {
                $debug->echoDebug(
                    "Souscomposant du composant n° ".$component->getParent()
                    ->getId()." n° " . $component->getId() . " : " .
                    $component->getName() . "<BR>" . $component->getDescription()
                    . "<BR>"
                );
            }
            // on teste s'il existe des sous composants
        }
        if (count($repositoryC->findByParent($component->getId())) > 0) {
            $subcomponents = $repositoryC->findByParent($component->getId());
            getComponentChildren($subcomponents);
        }

    }

}
