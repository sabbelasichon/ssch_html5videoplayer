<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'HTML5 audio- and videoplayer based on mediaelement.js',
    'description' => 'Creates an HTML5 audio- and videoplayer based on mediaelement.js with Flash-Fallback on older browsers.',
    'category' => 'plugin',
    'author' => 'Sebastian Schreiber',
    'author_email' => 'me@schreibersebastian.de',
    'author_company' => 'Sebastian Schreiber',
    'state' => 'stable',
    'version' => '2.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-7.6.99',
            'static_info_tables' => '6.2'
        ],
        'suggests' => [
            'filemetadata' => '',
        ],
    ],
];
