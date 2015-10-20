<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// Register basic metadata extractor. Will feed the file with a "title" when indexing, e.g. upload, through scheduler
\TYPO3\CMS\Core\Resource\Index\ExtractorRegistry::getInstance()->registerExtractionService('Ssch\SschHtml5videoplayer\Index\MetadataExtractor');


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
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ssch.' . $_EXTKEY, 'Pi5', array(
    'Category' => 'filter',
        ),
        // non-cacheable actions
        array(
        )
);


$pluginsWithExtensionSummary = array('pi1', 'pi2', 'pi3', 'pi4', 'pi5');

foreach($pluginsWithExtensionSummary as $pluginWithExtensionSummary) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['sschhtml5videoplayer_' . $pluginWithExtensionSummary][] = 'Ssch\\SschHtml5videoplayer\\Hooks\\CmsLayout->getExtensionSummary';
}