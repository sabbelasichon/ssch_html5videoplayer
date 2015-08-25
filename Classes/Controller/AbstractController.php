<?php

namespace Ssch\SschHtml5videoplayer\Controller;

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

abstract class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     *
     * @var \Ssch\SschHtml5videoplayer\Utility\SorterUtility
     * @inject
     */
    protected $sorterUtility;

    /**
     * @return void
     */
    public function initializeAction() {
        $this->settings['baseUrl'] = GeneralUtility::getIndpEnv('TYPO3_SITE_URL');

        if ($this->settings['addHeaderData']) {

            $mediaElementJsFolder = $this->getFileAbsFileName($this->settings['mediaelementjsFolder']);
            if ($this->settings['addJQueryLibrary']) {
                $jQueryLibrary = $mediaElementJsFolder . 'build/jquery.js';
                $this->addHeaderData($jQueryLibrary, 'js');
            }
            if ($this->settings['addMediaElementJs']) {
                $locale = strtolower(\SJBR\StaticInfoTables\Utility\LocalizationUtility::getCurrentLanguage());
                if ($locale) {
                    $localeFile = $mediaElementJsFolder . sprintf('src/js/me-i18n-locale-%s.js', $locale);
                    if (file_exists($localeFile)) {
                        $this->addHeaderData('var mejs = mejs || {}; (function () { mejs.i18n = { locale: { language: "' . $locale . '", strings: { } } }; })();', 'script');
                        $this->addHeaderData($localeFile, 'js');
                    }
                }
                $mediaElementJsJavascript = $mediaElementJsFolder . 'build/mediaelement-and-player.min.js';
                $this->addHeaderData($mediaElementJsJavascript, 'js');

                $mediaElementJsCss = $mediaElementJsFolder . 'build/mediaelementplayer.min.css';
                $this->addHeaderData($mediaElementJsCss);
            }
            if ($this->settings['addMediaElementJsInitialization'] && !$this->settings['addMediaElementJsInitializationFile']) {
                $this->addHeaderData('jQuery(document).ready(function($) { $("video,audio").mediaelementplayer() });', 'script');
            } elseif ($this->settings['addMediaElementJsInitializationFile']) {
                $initializationFile = $this->getFileAbsFileName($this->settings['addMediaElementJsInitializationFile']);
                $fluidView = $this->objectManager->create('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
                /* @var $fluidView \TYPO3\CMS\Fluid\View\StandaloneView */
                $fluidView->setTemplatePathAndFilename($initializationFile);
                $fluidView->setPartialRootPath(dirname($initializationFile));
                $this->addHeaderData($fluidView->render(), 'none');
            }
        }
    }

    /**
     * 
     * @param string $data The file
     * @param string $type Css, Js, script
     * @return void
     */
    protected function addHeaderData($data, $type = 'css') {
        switch ($type) {
            case 'css':
                $data = '<link rel="stylesheet" type="text/css" media="all" href="' . $data . '" />';
                break;
            case 'js':
                $data = '<script type="text/javascript" src="' . $data . '"></script>';
                break;
            case 'script':
                $data = '<script>' . $data . '</script>';
                break;
        }
        $key = $this->extensionName . md5($data);
        if (!isset($GLOBALS['TSFE']->register[$key])) {
            $GLOBALS['TSFE']->register[$key] = $data;
            $this->response->addAdditionalHeaderData($data);
        }
    }

    /*************************
     *
     * TYPO3 SPECIFIC FUNCTIONS
     *
     * *********************** */

    /**
     * Returns the absolute filename of a relative reference, resolves the "EXT:" prefix
     * (way of referring to files inside extensions) and checks that the file is inside
     * the PATH_site of the TYPO3 installation and implies a check with
     * \TYPO3\CMS\Core\Utility\GeneralUtility::validPathStr().
     *
     * @param string $filename The input filename/filepath to evaluate
     * @param boolean $onlyRelative If $onlyRelative is set (which it is by default), then only return values relative to the current PATH_site is accepted.
     * @param boolean $relToTYPO3_mainDir If $relToTYPO3_mainDir is set, then relative paths are relative to PATH_typo3 constant - otherwise (default) they are relative to PATH_site
     * @return string Returns the absolute filename of $filename if valid, otherwise blank string.
     */
    public function getFileAbsFileName($filename, $onlyRelative = TRUE, $relToTYPO3_mainDir = FALSE) {
        $filename = GeneralUtility::getFileAbsFileName($filename);
        return str_replace(PATH_site, '', $filename);
    }

}

?>