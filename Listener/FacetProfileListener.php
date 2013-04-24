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


/**
 * Listener Profile Bundle
 */
class FacetProfileListener extends ContainerAware
{
    public $debug ;
    /**  fonction Apppele par le listeners
     * fonction Apppele par le listeners
     *
     * @param \Claroline\CoreBundle\Library\Event\DisplayToolEvent $event
     * Evenement declenché par le bureau claroline
     *
     * @return none
     */

    public function onStartUp(DisplayToolEvent $event)
    {

         $twig = $this->container->get('templating');
         $vue = $twig->render('ImaviaFacetProfileBundle::MenuGeneral.html.twig');
         $event->setContent($vue);
    }
}