<?php


foreach (array_keys($dca['palettes']) as $palette) {
	$dca['palettes'][$palette] = str_replace(';{layout_legend', ';{onepage_legend},in_onepage,switch_order;{layout_legend', $dca['palettes'][$palette]);
}

$fields = [
		'in_onepage'			  => [
		'label'                   =>  &$GLOBALS['TL_LANG']['tl_page']['in_onepage'],
    	'exclude'                 => true,
    	'inputType'               => 'checkbox',
    	'eval'                    => array('tl_class'=>'w50'),
    	'sql'                     => "char(1) NOT NULL default ''"
	],
	'switch_order' => [
		'label'                   =>  &$GLOBALS['TL_LANG']['tl_page']['switch_order'],
		'exclude'                 => true,
		'inputType'               => 'checkbox',
		'eval'                    => array('tl_class'=>'w50'),
		'sql'                     => "char(1) NOT NULL default ''"
	]
];

// Create array if it doesn't exist
if ( ! isset($dca['fields'])) {
   $dca['fields'] = [];
}
$dca['fields'] += $fields;