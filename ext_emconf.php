<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'HTML5 audio- and videoplayer based on mediaelement.js',
    'description' => 'Creates an HTML5 audio- and videoplayer based on mediaelement.js with Flash-Fallback on older browsers.',
    'category' => 'plugin',
    'author' => 'Sebastian Schreiber',
    'author_email' => 'me@schreibersebastian.de',
    'author_company' => 'Sebastian Schreiber',
    'state' => 'stable',
    'version' => '1.2.7',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.2.0-6.2.99',
            'static_info_tables' => '6.2',
        ),
        'suggests' => array(
            'filemetadata' => '',
        ),
    ),
);
