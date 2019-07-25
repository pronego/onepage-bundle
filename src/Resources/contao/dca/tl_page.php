<?php

//$GLOBALS['TL_DCA']['tl_page']['palettes']['default']=preg_replace('/{expert_legend:hide}/','{onepage_legend:hide},in_onepage;{expert_legend:hide}',$GLOBALS['TL_DCA']['tl_page']['palettes']['default']);

foreach (array_keys($dca['palettes']) as $palette) {
	$dca['palettes'][$palette] = str_replace(';{layout_legend', ';{onepage_legend},in_onepage;{layout_legend', $dca['palettes'][$palette]);
}

$fields = [
	'in_onepage'                    => [
		'label'                   =>  "Test",//&$GLOBALS['TL_LANG']['tl_article']['in_onepage'],
    	'exclude'                 => true,
    	'inputType'               => 'checkbox',
    	'eval'                    => array('tl_class'=>'w50'),
    	'sql'                     => "char(1) NOT NULL default ''"
	],
];

$dca['fields'] += $fields;