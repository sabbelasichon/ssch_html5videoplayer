<?php

namespace Ssch\SschHtml5videoplayer\UserFuncs;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use TYPO3\CMS\Core\Html\HtmlParser;
use TYPO3\CMS\Core\TypoScript\ExtendedTemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Page\PageRepository;

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
        $template = GeneralUtility::makeInstance(ExtendedTemplateService::class);   // Defined global here!
        /* @var $template ExtendedTemplateService */
        $template->tt_track = 0;
        $template->init();

        $sysPage = GeneralUtility::makeInstance(PageRepository::class);
        /* @var $sysPage PageRepository */
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
                $pathToFiles = $template->setup['plugin.']['tx_sschhtml5videoplayer.']['view.']['templateRootPath'] . 'Audio/';
                break;
            default:
                $extFileList = 'html,htm';
                $pathToFiles = $template->setup['plugin.']['tx_sschhtml5videoplayer.']['view.']['templateRootPath'] . 'Video/';
                break;
        }

        // Finding value for the path containing the template files
        $readPath = GeneralUtility::getFileAbsFileName($pathToFiles);

        // If that direcotry is valid, is a directory then select files in it:
        if (is_dir($readPath)) {
            //getting all HTML files in the directory:
            $templateFiles = GeneralUtility::getFilesInDir($readPath, $extFileList, 1, 1);
            // Start up the HTML parser:
            $parseHTML = GeneralUtility::makeInstance(HtmlParser::class);
            /* @var $parserHTML \TYPO3\CMS\Core\Html\HtmlParser */
            foreach ($templateFiles as $htmlFilePath) {
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
                    $selectorBoxItemTitle = trim($titleTagContent . ' (' . basename($htmlFilePath) . ')');
                    $fI = GeneralUtility::split_fileref($htmlFilePath);
                    $testImageFilename = $readPath . 'Icons/' . $fI['filebody'] . '.gif';
                    if (is_file($testImageFilename)) {
                        $selectorBoxItemIcon = '../' . substr($testImageFilename, strlen(PATH_site));
                    }

                    if (true === $fullPath) {
                        $pathToFile = $htmlFilePath;
                    } else {
                        $pathToFile = basename($htmlFilePath);
                    }
                    $params['items'][] = [$selectorBoxItemTitle, $pathToFile, $selectorBoxItemIcon];
                }
            }
        }
    }
}
