<?php

namespace Ssch\SschHtml5videoplayer\Command;

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

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

class UpgradeCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController {

    /**
     *
     * @var \tx_extdeveval_llxml2xliff
     * @inject
     */
    protected $converterTool;

    /**
     * Converts all old .xml to xliff files
     */
    public function convertXmlToXliffCommand() {
        $extensionDirAbsolute = ExtensionManagementUtility::extPath('ssch_html5videoplayer');
        $pathToFiles = $extensionDirAbsolute . 'Resources/Private/Language/';
        $xmlFiles = GeneralUtility::getFilesInDir($pathToFiles, 'xml', FALSE);
        foreach ($xmlFiles as $xmlFile) {
            $newFileName = str_replace('.xml', '.xlf', $xmlFile);
            $languages = $this->converterTool->getAvailableTranslations($pathToFiles . $xmlFile);
            foreach ($languages as $language) {
                if ('default' !== $language) {
                    $newFileName = $language . '.' . basename($newFileName);
                }
                $this->converterTool->renderSaveDone($pathToFiles . $xmlFile, $pathToFiles . $newFileName, $language);
            }
        }
    }

}
