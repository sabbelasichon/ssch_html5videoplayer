<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('ssch_html5videoplayer', 'Configuration/TypoScript',
    'HTML5Videoplayer');
