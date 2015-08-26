<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        $_EXTKEY, 'Pi1', 'Video - Liste'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        $_EXTKEY, 'Pi2', 'Video - Details'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        $_EXTKEY, 'Pi3', 'Audio - Liste'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        $_EXTKEY, 'Pi4', 'Audio - Details'
);


// Flexforms
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginsWithFlexForms = array('Pi1', 'Pi2', 'Pi3', 'Pi4');

foreach ($pluginsWithFlexForms as $pluginWithFlexForm) {
    $pluginSuffix = '_' . lcfirst($pluginWithFlexForm);
    $pluginSignature = strtolower($extensionName) . $pluginSuffix;
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/' . $pluginWithFlexForm . '.xlf');
}


TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'HTML5Videoplayer');


TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sschhtml5videoplayer_domain_model_video', 'EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_csh_tx_sschhtml5videoplayer_domain_model_video.xlf');
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sschhtml5videoplayer_domain_model_video');
$TCA['tx_sschhtml5videoplayer_domain_model_video'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_video',
        'label' => 'title',
        'label_userFunc' => 'EXT:ssch_html5videoplayer/Classes/UserFuncs/Labels.php:\Ssch\SschHtml5videoplayer\UserFuncs\Labels->getLabel',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'sortby' => 'sorting',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'dynamicConfigFile' => TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Video.php',
        'iconfile' => TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_sschhtml5videoplayer_domain_model_video.gif',
        'searchFields' => 'title,short_title,caption,alt,longdesc'
    ),
);

TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sschhtml5videoplayer_domain_model_subtitle', 'EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_csh_tx_sschhtml5videoplayer_domain_model_subtitle.xlf');
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sschhtml5videoplayer_domain_model_subtitle');
$TCA['tx_sschhtml5videoplayer_domain_model_subtitle'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_subtitle',
        'label' => 'track',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'sortby' => 'sorting',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'dynamicConfigFile' => TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Subtitle.php',
        'iconfile' => TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_sschhtml5videoplayer_domain_model_subtitle.gif'
    ),
);

TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sschhtml5videoplayer_domain_model_audio', 'EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_csh_tx_sschhtml5videoplayer_domain_model_audio.xlf');
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sschhtml5videoplayer_domain_model_audio');
$TCA['tx_sschhtml5videoplayer_domain_model_audio'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_db.xlf:tx_sschhtml5videoplayer_domain_model_audio',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'dynamicConfigFile' => TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Audio.php',
        'iconfile' => TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_sschhtml5videoplayer_domain_model_audio.gif'
    ),
);


if (TYPO3_MODE == 'BE') {
    $GLOBALS['TBE_MODULES_EXT']['xMOD_db_new_content_el']['addElClasses']['Ssch\\SschHtml5videoplayer\\Wizicon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('ssch_html5videoplayer') . 'Classes/Wizicon.php';
}