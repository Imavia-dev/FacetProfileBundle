<?php

namespace Imavia\FacetProfileBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerAware;
use Claroline\CoreBundle\Library\Event\DisplayToolEvent;

class FacetProfileListener extends ContainerAware 
{
    public function onStartUp(DisplayToolEvent $event)
    {
        
        $twig = $this->container->get('templating');
        $vue=$twig->render('ImaviaFacetProfileBundle::HelloWorld.html.twig');
        $event->setContent($vue);
    }
}

?>
