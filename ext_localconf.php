<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ssch.' . $_EXTKEY, 'Pi1', array(
    'Video' => 'list, show',   
        ),
        // non-cacheable actions
        array(        
        )
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ssch.' . $_EXTKEY, 'Pi2', array(
    'Video' => 'show',    
        ),
        // non-cacheable actions
        array(        
        )
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ssch.' . $_EXTKEY, 'Pi3', array(
    'Audio' => 'list, show',   
        ),
        // non-cacheable actions
        array(        
        )
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ssch.' . $_EXTKEY, 'Pi4', array(
    'Audio' => 'show',    
        ),
        // non-cacheable actions
        array(        
        )
);
?>