<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sschhtml5videoplayer_domain_model_video',
    'EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_csh_tx_sschhtml5videoplayer_domain_model_video.xlf');
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sschhtml5videoplayer_domain_model_video');

TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sschhtml5videoplayer_domain_model_subtitle',
    'EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_csh_tx_sschhtml5videoplayer_domain_model_subtitle.xlf');
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sschhtml5videoplayer_domain_model_subtitle');

TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sschhtml5videoplayer_domain_model_audio',
    'EXT:ssch_html5videoplayer/Resources/Private/Language/locallang_csh_tx_sschhtml5videoplayer_domain_model_audio.xlf');
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sschhtml5videoplayer_domain_model_audio');
