<?php
/**
 * Bundle Imavia FacetProfile
 *    
 * @author Jerome Varini <jerome.varini@imavia.fr>
 * @author Fricker Sebastien <sebastien.fricker@imavia.fr>
 * @link   http://www.imavia.fr Site web Imavia
 * 
 */
namespace Imavia\FacetProfileBundle;

use Claroline\CoreBundle\Library\PluginBundle;

/*
 * Imavia Facet Profile Bundle
 */

class ImaviaFacetProfileBundle extends PluginBundle
{
    public function getRoutingPrefix()
    {
        return "imavia";
    }
}
