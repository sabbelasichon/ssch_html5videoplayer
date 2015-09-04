<?php

namespace Ssch\SschHtml5videoplayer\Domain\Model;

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

/**
 * Video
 */
class Audio extends AbstractVideoAudioEntity {

    /**
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $audioSource;

    /**
     * image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image = NULL;
    
    /**
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getAudioSource() {
        return $this->audioSource;
    }

    /**
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $audioSource
     */
    public function setAudioSource(\TYPO3\CMS\Extbase\Domain\Model\FileReference $audioSource) {
        $this->audioSource = $audioSource;
    }

    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
        $this->image = $image;
    }
    
    /**
     * 
     * @return string
     */
    public function getUrl() {
        return $this->audioSource->getOriginalResource()->getPublicUrl();
    }

}