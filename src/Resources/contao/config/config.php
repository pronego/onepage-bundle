<?php

array_insert($GLOBALS['FE_MOD']['navigationMenu'],1, array(
        'jl-onepage-nav' => 'ModuleJlOnepage'
    )
);

#Hooks
//$GLOBALS['TL_HOOKS']['getArticle'][] = array('jl.onepage.hooks', 'addAliasToArticleCssId');
//$GLOBALS['TL_HOOKS']['getArticle'][] = array('OnepageHooks', 'addAliasToArticleCssId');

