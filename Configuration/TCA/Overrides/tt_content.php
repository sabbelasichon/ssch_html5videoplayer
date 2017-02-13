<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ssch_html5videoplayer', 'Pi1', 'Video - Liste'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ssch_html5videoplayer', 'Pi2', 'Video - Details'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ssch_html5videoplayer', 'Pi3', 'Audio - Liste'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ssch_html5videoplayer', 'Pi4', 'Audio - Details'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ssch_html5videoplayer', 'Pi5', 'Category - Filter'
);

// Flexforms
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('ssch_html5videoplayer');
$pluginsWithFlexForms = ['Pi1', 'Pi2', 'Pi3', 'Pi4', 'Pi5'];

foreach ($pluginsWithFlexForms as $pluginWithFlexForm) {
    $pluginSuffix = '_' . lcfirst($pluginWithFlexForm);
    $pluginSignature = strtolower($extensionName) . $pluginSuffix;
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature,
        'FILE:EXT:ssch_html5videoplayer/Configuration/FlexForms/' . $pluginWithFlexForm . '.xml');
}


