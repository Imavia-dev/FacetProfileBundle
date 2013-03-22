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
       $em = $this->getDoctrine()->getManager();
       
       $profile = new Profile();
       $facet = new Facet();
       $facet2 = new Facet();
       
       $facet->setName('Facette N°1');
       $facet->setDescription('Première facette enregistrée en bdd ');
       $facet->setCreationDate('22/03/2013');
       $facet->setLastModificationDate('22/03/2013');
       $facet->setProfile($profile->getId());
       
       $facet2->setName('Facette N°2');
       $facet2->setDescription('Deuxiemme facette enregistrée en bdd ');
       $facet2->setCreationDate('22/03/2013');
       $facet2->setLastModificationDate('22/03/2013');
       $facet2->setProfile($profile->getId());
       
       $em->persist($profile);
       $em->persist($facet);
       $em->persist($facet2);
        
       $em->flush($profile);
       $em->flush($facet);
       $em->flush($facet2);
              
        $twig = $this->container->get('templating');
        $vue = $twig->render('ImaviaFacetProfileBundle::HelloWorld.html.twig');
        $event->setContent($vue);
    }
}
