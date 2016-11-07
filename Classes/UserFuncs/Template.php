<?php

namespace Ssch\SschHtml5videoplayer\UserFuncs;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Sebastian Schreiber <me@schreibersebastian.de>, Sebastian Schreiber
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use TYPO3\CMS\Core\Utility\GeneralUtility;

class Template
{
    /**
     * @param array  $params
     * @param object $pObj
     */
    public function main(&$params, &$pObj)
    {
        global $BE_USER;

        $thePageId = $params['row']['pid'];
        $template = GeneralUtility::makeInstance('\TYPO3\CMS\Core\TypoScript\ExtendedTemplateService');   // Defined global here!
        /* @var $template \TYPO3\CMS\Core\TypoScript\ExtendedTemplateService */
        $template->tt_track = 0;
        $template->init();

        $sysPage = GeneralUtility::makeInstance('\TYPO3\CMS\Frontend\Page\PageRepository');
        /* @var $sysPage \TYPO3\CMS\Frontend\Page\PageRepository */
        $rootLine = $sysPage->getRootLine($thePageId);
        // This generates the constants/config + hierarchy info for the template.
        $template->runThroughTemplates($rootLine, 0);
        $template->generateConfig();

        $fullPath = false;
        switch ($params['config']['path']) {
            case 'JavaScripts':
                $fullPath = true;
                $extFileList = 'html,htm,js';
                $pathToFiles = $template->setup['plugin.']['tx_sschhtml5videoplayer.']['view.']['templateRootPathInitializationFiles'];
                break;
            case 'Audio':
                $extFileList = 'html,htm';
                $pathToFiles = $template->setup['plugin.']['tx_sschhtml5videoplayer.']['view.']['templateRootPath'].'Audio/';
                break;
            default:
                $extFileList = 'html,htm';
                $pathToFiles = $template->setup['plugin.']['tx_sschhtml5videoplayer.']['view.']['templateRootPath'].'Video/';
                break;
        }

        // Finding value for the path containing the template files
        $readPath = GeneralUtility::getFileAbsFileName($pathToFiles);

        // If that direcotry is valid, is a directory then select files in it:
        if (is_dir($readPath)) {
            #\TYPO3\CMS\Core\Utility\DebugUtility::debug($readPath);
            //getting all HTML files in the directory:
            $templateFiles = GeneralUtility::getFilesInDir($readPath, $extFileList, 1, 1);
            // Start up the HTML parser:
            $parseHTML = GeneralUtility::makeInstance('\TYPO3\CMS\Core\Html\HtmlParser');
            /* @var $parserHTML \TYPO3\CMS\Core\Html\HtmlParser */
            foreach ($templateFiles as $htmlFilePath) {
                $selectorBoxItemTitle = '';
                $selectorBoxItemIcon = '';
                $content = GeneralUtility::getUrl($htmlFilePath);
                $titles = $parseHTML->splitIntoBlock('titles', $content);
                $language = $BE_USER->uc['lang'] == '' ? 'default' : $BE_USER->uc['lang'];

                $titlesLang = $parseHTML->splitIntoBlock($language, $titles[1]);
                if (count($titlesLang) < 2) {
                    $titlesLang = $parseHTML->splitIntoBlock('default', $titles[1]);
                }
                $titleTagContent = $parseHTML->removeFirstAndLastTag($titlesLang[1]);

                if ($titleTagContent) {
                    $selectorBoxItemTitle = trim($titleTagContent.' ('.basename($htmlFilePath).')');
                    $fI = GeneralUtility::split_fileref($htmlFilePath);
                    $testImageFilename = $readPath.'Icons/'.$fI['filebody'].'.gif';
                    if (is_file($testImageFilename)) {
                        $selectorBoxItemIcon = '../'.substr($testImageFilename, strlen(PATH_site));
                    }

                    if (true === $fullPath) {
                        $pathToFile = $htmlFilePath;
                    } else {
                        $pathToFile = basename($htmlFilePath);
                    }
                    $params['items'][] = array($selectorBoxItemTitle, $pathToFile, $selectorBoxItemIcon);
                }
            }
        }
    }
}
