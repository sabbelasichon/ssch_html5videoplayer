<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

require_once TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Vendors' . DIRECTORY_SEPARATOR . 'autoload.php';

// Register basic metadata extractor. Will feed the file with a "title" when indexing, e.g. upload, through scheduler
\TYPO3\CMS\Core\Resource\Index\ExtractorRegistry::getInstance()->registerExtractionService('Ssch\\SschHtmlvideoplayer\\Index\\MetadataExtractor');


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