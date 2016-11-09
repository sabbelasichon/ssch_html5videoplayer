<?php

namespace Ssch\SschHtml5videoplayer\Hooks;

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
use TYPO3\CMS\Lang\LanguageService;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CmsLayout
{
    /**
     * @var array
     */
    protected $flexformData;

    /**
     * @param array $params
     *
     * @return string
     */
    public function getExtensionSummary(array $params)
    {
        $LL = $this->includeLocalLang();
        $result = '<strong><cite>&rarr; '.$this->getLanguage()->getLLL('list_title_'.$params['row']['list_type'],
                $LL).' </cite></strong>';
        $this->flexformData = GeneralUtility::xml2array($params['row']['pi_flexform']);
        if ($this->getFieldFromFlexform('settings.videoWidth')) {
            $result .= '<br /><strong>Width:</strong>: '.$this->getFieldFromFlexform('settings.videoWidth');
        }
        if ($this->getFieldFromFlexform('settings.videoHeight')) {
            $result .= '<br /><strong>Height</strong>: '.$this->getFieldFromFlexform('settings.videoHeight');
        }
        if ($this->getFieldFromFlexform('settings.templateFile')) {
            $result .= '<br /><strong>Template</strong>: '.$this->getFieldFromFlexform('settings.templateFile');
        }
        if ($this->getFieldFromFlexform('settings.addMediaElementJsInitializationFile')) {
            $result .= '<br /><strong>MediaelementInit</strong>: '.basename($this->getFieldFromFlexform('settings.addMediaElementJsInitializationFile'));
        }
        if ($this->getFieldFromFlexform('settings.skin')) {
            $result .= '<br /><strong>Skin</strong>: '.$this->getFieldFromFlexform('settings.skin');
        }
        if ($this->getFieldFromFlexform('settings.videoSelection')) {
            $this->addItemsToResult($this->getItemsByTableAndUids($this->getFieldFromFlexform('settings.videoSelection')),
                $result);
        }
        if ($this->getFieldFromFlexform('settings.audioSelection')) {
            $this->addItemsToResult($this->getItemsByTableAndUids($this->getFieldFromFlexform('settings.audioSelection'),
                'tx_sschhtml5videoplayer_domain_model_audio'), $result);
        }

        return $result;
    }

    /**
     * @param array  $items
     * @param string $result
     */
    protected function addItemsToResult($items, &$result)
    {
        $result .= '<br /><ul style="margin-bottom: 0;">';
        foreach ($items as $item) {
            $result .= '<li>'.$item['title'].'</li>';
        }
        $result .= '</ul>';
    }

    /**
     * @param string $uids
     * @param string $table
     *
     * @return array|null
     */
    protected function getItemsByTableAndUids($uids, $table = 'tx_sschhtml5videoplayer_domain_model_video')
    {
        return $this->getDatabaseConnection()->exec_SELECTgetRows($table.'.*', $table,
            $table.'.uid IN( '.$this->getDatabaseConnection()->cleanIntList($uids).')');
    }

    /**
     * Get field value from flexform configuration,
     * including checks if flexform configuration is available.
     *
     * @param string $key   name of the key
     * @param string $sheet name of the sheet
     *
     * @return string|null if nothing found, value if found
     */
    protected function getFieldFromFlexform($key, $sheet = 'displayCode')
    {
        $flexform = $this->flexformData;
        if (isset($flexform['data'])) {
            $flexform = $flexform['data'];
            if (is_array($flexform) && is_array($flexform[$sheet]) && is_array($flexform[$sheet]['lDEF']) && is_array($flexform[$sheet]['lDEF'][$key]) && isset($flexform[$sheet]['lDEF'][$key]['vDEF'])) {
                return $flexform[$sheet]['lDEF'][$key]['vDEF'];
            }
        }

        return null;
    }

    /**
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }

    /**
     * Get language service.
     *
     * @return LanguageService
     */
    protected function getLanguage()
    {
        return $GLOBALS['LANG'];
    }

    /**
     * Reads the [extDir]/locallang.xml and returns the $LOCAL_LANG array found in that file.
     *
     * @return array The array with language labels
     */
    protected function includeLocalLang()
    {
        $llFile = ExtensionManagementUtility::extPath('ssch_html5videoplayer').'Resources/Private/Language/locallang_db.xlf';
        $parser = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Localization\\LocalizationFactory');

        /* @var $parser \TYPO3\CMS\Core\Localization\LocalizationFactory */
        return $parser->getParsedData($llFile, $this->getLanguage()->lang, 'utf-8', 1);
    }
}
