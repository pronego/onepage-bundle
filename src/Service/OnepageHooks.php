<?php

/**
 * @copyright
 *
 * @license LGPL-3.0+
 */

namespace Jl\OnepageNav\Service;

/*
* @author Jonas Linn
*
*/
class OnepageHooks
{
    public function addAliasToArticleCssId($objData){
        $arrCSS = deserialize($objData->cssID, true);
        if(strlen($objData->in_onepage) && strlen($objData->published)){
            $arrCSS[0] =  trim($arrCSS[0] . " " . $objData->alias);
        }
        $objData->cssID = serialize($arrCSS);
    }
}