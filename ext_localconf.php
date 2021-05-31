<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Ssch.' . $_EXTKEY,
    'Pi1',
    [
    'Video' => 'list, show',
],
    // non-cacheable actions
    []
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Ssch.' . $_EXTKEY,
    'Pi2',
    [
    'Video' => 'show',
],
    // non-cacheable actions
    []
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Ssch.' . $_EXTKEY,
    'Pi3',
    [
    'Audio' => 'list, show',
],
    // non-cacheable actions
    []
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Ssch.' . $_EXTKEY,
    'Pi4',
    [
    'Audio' => 'show',
],
    // non-cacheable actions
    []
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Ssch.' . $_EXTKEY,
    'Pi5',
    [
    'Category' => 'filter',
],
    // non-cacheable actions
    []
);

$pluginsWithExtensionSummary = ['pi1', 'pi2', 'pi3', 'pi4', 'pi5'];

foreach ($pluginsWithExtensionSummary as $pluginWithExtensionSummary) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['sschhtml5videoplayer_' . $pluginWithExtensionSummary][] = 'Ssch\\SschHtml5videoplayer\\Hooks\\CmsLayout->getExtensionSummary';
}

// Wizard configuration
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ssch_html5videoplayer/Configuration/TypoScript/TSconfig/ContentElementWizard.ts">');

// Update scripts
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['ssch_html5videoplayer_videos'] = \Ssch\SschHtml5videoplayer\Updates\VideoLinksToFileReferences::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['ssch_html5videoplayer_audios'] = \Ssch\SschHtml5videoplayer\Updates\AudioLinksToFileReferences::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['ssch_html5videoplayer_tracks'] = \Ssch\SschHtml5videoplayer\Updates\TracksToFileReferences::class;
