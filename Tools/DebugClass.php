<?php

namespace Imavia\FacetProfileBundle\Tools;

class DebugClass
{
    private $afficheDebug;

    public function setAfficheDebug($afficheDebug)
    {
        $this->afficheDebug = $afficheDebug;
    }

    public function echoDebug($texte)
    {
        if ($this->afficheDebug) {
            echo($texte);
        }
    }
}
