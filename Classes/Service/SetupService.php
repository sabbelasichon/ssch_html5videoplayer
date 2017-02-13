<?php


namespace Ssch\SschHtml5videoplayer\Service;

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

use TYPO3\CMS\Core\SingletonInterface;

class SetupService implements SingletonInterface
{
    /**
     * @var array
     */
    private $settings;


    /**
     * @param array $settings
     */
    public function injectSettings(array $settings = array())
    {
        $this->settings = $settings;
    }

    /**
     * @return mixed
     */
    public function getAudioTemplateFolder()
    {
        return $this->settings['plugin.']['tx_sschhtml5videoplayer.']['view.']['templateRootPath'].'Audio/';
    }

    /**
     * @return mixed
     */
    public function getVideoTemplateFolder()
    {
        return $this->settings['plugin.']['tx_sschhtml5videoplayer.']['view.']['templateRootPath'].'Video/';
    }

    /**
     * @return mixed
     */
    public function getInitializationFiles()
    {
        return $this->settings['plugin.']['tx_sschhtml5videoplayer.']['view.']['templateRootPath'];
    }

}