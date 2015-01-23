<?php

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Sebastian Schreiber <ssch@hauptweg-nebenwege.de>, Hauptweg Nebenwege GmbH
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

/**
 * PageteaserController
 */
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ext_update {

    /**
     * @return void
     */
    public function main() {
        $this->upgradeContentElements();
    }

    /**
     * 
     * @param string $pluginName
     * @return void
     */
    protected function upgradeContentElements($pluginName = 'sschhtml5videoplayer_pi1') {
        $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, pid, pi_flexform, list_type', 'tt_content', 'CType=\'list\' AND list_type=\'' . $pluginName . '\'');

        $flexformTools = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('\TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools');
        /* @var $flexformTools \TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools */
        while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {

            $xmlArray = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array($row['pi_flexform']);
            if (!is_array($xmlArray) || !isset($xmlArray['data'])) {
                // Something went wrong
            } else {
                $data = $xmlArray['data']['displayCode']['lDEF'];
                $xmlArrayUpdated = array();
                $switchableControllerAction = $data['switchableControllerActions']['vDEF'];
                $videoSelection = NULL;
                $audioSelection = NULL;
                $videoHeight = NULL;
                $videoWidth = NULL;
                $templateFile = NULL;
                $addMediaElementJsInitializationFile = NULL;
                switch ($switchableControllerAction) {
                    case 'Video->list':
                        $listType = 'sschhtml5videoplayer_pi1';
                        $videoSelection = $data['settings.videoSelection']['vDEF'];
                        break;
                    case 'Video->listGallery':
                        $listType = 'sschhtml5videoplayer_pi1';
                        $videoSelection = $data['settings.videoSelection']['vDEF'];
                        break;
                    case 'Video->show':
                        $listType = 'sschhtml5videoplayer_pi2';
                        $videoSelection = $data['settings.videoSelection']['vDEF'];
                        $videoHeight = $data['settings.videoHeight']['vDEF'];
                        $videoWidth = $data['settings.videoWidth']['vDEF'];
                        break;
                    case 'Video->showFull':
                        $listType = 'sschhtml5videoplayer_pi2';
                        $videoSelection = $data['settings.videoSelection']['vDEF'];
                        #$templateFile = 'ShowFull.html';
                        #$addMediaElementJsInitializationFile = 'MediaElementJsInitializationFull.html';
                        $videoHeight = $data['settings.videoHeight']['vDEF'];
                        $videoWidth = $data['settings.videoWidth']['vDEF'];
                        break;
                    case 'Video->teaser':
                        $listType = 'sschhtml5videoplayer_pi2';
                        $videoSelection = $data['settings.videoSelection']['vDEF'];
                        $templateFile = 'Teaser.html';
                        $videoHeight = $data['settings.videoHeight']['vDEF'];
                        $videoWidth = $data['settings.videoWidth']['vDEF'];
                        break;
                    case 'Video->stage':
                        $listType = 'sschhtml5videoplayer_pi2';
                        $videoSelection = $data['settings.videoSelection']['vDEF'];
                        $templateFile = 'Stage.html';
                        $videoHeight = $data['settings.videoHeight']['vDEF'];
                        $videoWidth = $data['settings.videoWidth']['vDEF'];
                        break;
                    case 'Audio->list':
                        $listType = 'sschhtml5videoplayer_pi3';
                        $audioSelection = $data['settings.audioSelection']['vDEF'];
                        break;
                    case 'Audio->show':
                        $listType = 'sschhtml5videoplayer_pi4';
                        $audioSelection = $data['settings.audioSelection']['vDEF'];
                        break;
                }

                if (NULL !== $videoSelection) {
                    $xmlArrayUpdated['data']['displayCode']['lDEF']['settings.videoSelection']['vDEF'] = $videoSelection;
                }
                if (NULL !== $videoHeight) {
                    $xmlArrayUpdated['data']['displayCode']['lDEF']['settings.videoHeight']['vDEF'] = $videoHeight;
                }
                if (NULL !== $videoWidth) {
                    $xmlArrayUpdated['data']['displayCode']['lDEF']['settings.videoWidth']['vDEF'] = $videoWidth;
                }
                if (NULL !== $audioSelection) {
                    $xmlArrayUpdated['data']['displayCode']['lDEF']['settings.audioSelection']['vDEF'] = $audioSelection;
                }
                if (NULL !== $templateFile) {
                    $xmlArrayUpdated['data']['displayCode']['lDEF']['settings.templateFile']['vDEF'] = $templateFile;
                }
                if (NULL !== $addMediaElementJsInitializationFile) {

                    $thePageId = 7318;
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
                    $pathToInitializationFiles = $template->setup['plugin.']['tx_sschhtml5videoplayer.']['view.']['templateRootPathInitializationFiles'];
                    $addMediaElementJsInitializationFile = PATH_site . $pathToInitializationFiles . $addMediaElementJsInitializationFile;
                    $xmlArrayUpdated['data']['displayCode']['lDEF']['settings.addMediaElementJsInitializationFile']['vDEF'] = $addMediaElementJsInitializationFile;
                }


                if ($listType) {
                    $fieldValues['list_type'] = $listType;
                    if (!empty($xmlArrayUpdated)) {
                        $fieldValues['pi_flexform'] = $flexformTools->flexArray2Xml($xmlArrayUpdated);
                    }
                    #\TYPO3\CMS\Core\Utility\DebugUtility::debug($xmlArrayUpdated, $row['pid']);
                    $this->getDatabaseConnection()->exec_UPDATEquery('tt_content', 'uid=' . $row['uid'], $fieldValues);
                }
            }
        }
    }

    /**
     * @return TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected function getDatabaseConnection() {
        return $GLOBALS['TYPO3_DB'];
    }

    /**
     * Called by the extension manager to determine if the update menu entry
     * should by showed.
     *
     * @return bool
     * @todo find a better way to determine if update is needed or not.
     */
    public function access() {
        return TRUE;
    }

}

?>