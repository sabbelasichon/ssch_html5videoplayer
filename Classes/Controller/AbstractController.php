<?php

namespace Ssch\SschHtml5videoplayer\Controller;

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
use SJBR\StaticInfoTables\Utility\LocalizationUtility;
use Ssch\SschHtml5videoplayer\Utility\SorterUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Fluid\View\StandaloneView;

abstract class AbstractController extends ActionController
{
    /**
     * @var SorterUtility
     */
    protected $sorterUtility;

    /**
     * Initialize action. Called before every action method
     */
    public function initializeAction()
    {
        $this->settings['baseUrl'] = GeneralUtility::getIndpEnv('TYPO3_SITE_URL');
        $mediaElementJsFolder = $this->getFileAbsFileName($this->settings['mediaelementjsFolder']);
        $this->settings['mediaelementjsFolderRelative'] = $mediaElementJsFolder;
        if ($this->settings['addHeaderData']) {
            if ($this->settings['addJQueryLibrary']) {
                $jQueryLibrary = $mediaElementJsFolder . 'build/jquery.js';
                $this->addHeaderData($jQueryLibrary, 'js');
            }
            if ($this->settings['addMediaElementJs']) {
                $locale = strtolower(LocalizationUtility::getCurrentLanguage());
                if ($locale) {
                    $localeFile = $mediaElementJsFolder . sprintf('src/js/me-i18n-locale-%s.js', $locale);
                    if (file_exists($localeFile)) {
                        $this->addHeaderData('var mejs = mejs || {}; (function () { mejs.i18n = { locale: { language: "' . $locale . '", strings: { } } }; })();',
                            'script');
                        $this->addHeaderData($localeFile, 'js');
                    }
                }
                $mediaElementJsJavascript = $mediaElementJsFolder . 'build/mediaelement-and-player.min.js';
                $this->addHeaderData($mediaElementJsJavascript, 'js');

                $mediaElementJsCss = $mediaElementJsFolder . 'build/mediaelementplayer.min.css';
                $this->addHeaderData($mediaElementJsCss);

                if ($this->settings['skin']) {
                    $mediaElementSkinCss = $mediaElementJsFolder . 'build/mejs-skins.css';
                    if (file_exists($mediaElementSkinCss)) {
                        $this->addHeaderData($mediaElementSkinCss);
                    }
                }
            }
            if ($this->settings['addMediaElementJsInitialization'] && !$this->settings['addMediaElementJsInitializationFile']) {
                $this->addHeaderData('(function($) { $(document).ready(function() { $(\'video,audio\').mediaelementplayer(); });})(jQuery);',
                    'script');
            } elseif ($this->settings['addMediaElementJsInitializationFile']) {
                $initializationFile = $this->getFileAbsFileName($this->settings['addMediaElementJsInitializationFile']);
                $fluidView = $this->objectManager->get(StandaloneView::class);
                /* @var $fluidView StandaloneView */
                $fluidView->assign('settings', $this->settings);
                $fluidView->setTemplatePathAndFilename($initializationFile);
                $fluidView->setPartialRootPaths([dirname($initializationFile)]);
                $this->addHeaderData($fluidView->render(), 'none');
            }
        }
    }

    /**
     * @param SorterUtility $sorterUtility
     */
    public function injectSorterUtility(SorterUtility $sorterUtility)
    {
        $this->sorterUtility = $sorterUtility;
    }

    /**
     * @param string $data The file
     * @param string $type Css, Js, script
     */
    protected function addHeaderData($data, $type = 'css')
    {
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

    /**
     * Returns the absolute filename of a relative reference, resolves the "EXT:" prefix
     * (way of referring to files inside extensions) and checks that the file is inside
     * the PATH_site of the TYPO3 installation and implies a check with
     * \TYPO3\CMS\Core\Utility\GeneralUtility::validPathStr().
     *
     * @param string $filename           The input filename/filepath to evaluate
     * @param bool   $onlyRelative       If $onlyRelative is set (which it is by default), then only return values relative to the current PATH_site is accepted.
     * @param bool   $relToTYPO3_mainDir If $relToTYPO3_mainDir is set, then relative paths are relative to PATH_typo3 constant - otherwise (default) they are relative to PATH_site
     *
     * @return string Returns the absolute filename of $filename if valid, otherwise blank string.
     */
    public function getFileAbsFileName($filename, $onlyRelative = true, $relToTYPO3_mainDir = false)
    {
        $absFilename = GeneralUtility::getFileAbsFileName($filename, $onlyRelative, $relToTYPO3_mainDir);

        return str_replace(PATH_site, '', $absFilename);
    }
}
