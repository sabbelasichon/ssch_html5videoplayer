<?php

namespace Ssch\SschHtml5videoplayer;

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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Lang\LanguageService;

class Wizicon {

    /**
     * Processing the wizard items array
     *
     * @param array $wizardItems: The wizard items
     *
     * @return array Modified array with wizard items
     */
    function proc($wizardItems) {
        $LL = $this->includeLocalLang();


        $pluginsWithWizards = array('pi1', 'pi2', 'pi3', 'pi4');

        foreach ($pluginsWithWizards as $pluginWithWizard) {
            $pluginWithWizardWithPrefix = 'sschhtml5videoplayer_' . $pluginWithWizard;
            $wizardItems['plugins_tx_sschhtml5videoplayer_' . $pluginWithWizard] = array(
                'icon' => ExtensionManagementUtility::extRelPath('ssch_html5videoplayer') . '/Resources/Public/Icons/Wizicon.gif',
                'title' => $this->getLanguage()->getLLL('list_title_' . $pluginWithWizardWithPrefix, $LL),
                'description' => $this->getLanguage()->getLLL('list_plus_wiz_description_' . $pluginWithWizardWithPrefix, $LL),
                'params' => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=' . $pluginWithWizardWithPrefix
            );
        }
        return $wizardItems;
    }

    /**
     * Get language service
     *
     * @return LanguageService
     */
    protected function getLanguage() {
        return $GLOBALS['LANG'];
    }

    /**
     * Reads the [extDir]/locallang.xml and returns the $LOCAL_LANG array found in that file.
     *
     * @return  array   The array with language labels
     */
    protected function includeLocalLang() {
        $llFile = ExtensionManagementUtility::extPath('ssch_html5videoplayer') . '/Resources/Private/Language/locallang_db.xlf';
        $parser = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Localization\\Parser\\LocallangXmlParser');
        /* @var $parser \TYPO3\CMS\Core\Localization\Parser\LocallangXmlParser */
        $LOCAL_LANG = $parser->getParsedData($llFile, $GLOBALS['LANG']->lang);
        return $LOCAL_LANG;
    }

}
