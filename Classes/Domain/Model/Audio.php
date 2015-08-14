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
class Audio extends AbstractEntity {

    /**
     * Title
     *
     * @var string $title
     * @validate NotEmpty
     */
    protected $title;

    /**
     *
     * @var string
     */
    protected $audioSource;

    /**
     *
     * @var string
     */
    protected $description;

    /**
     * image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image = NULL;

    /**
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     *
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     *
     * @return string
     */
    public function getAudioSource() {
        return $this->getFile($this->audioSource);
    }

    /**
     *
     * @param string $audioSource
     */
    public function setAudioSource($audioSource) {
        $this->audioSource = $audioSource;
    }

    /**
     * Return the title
     * @return string 
     */
    public function __toString() {
        return $this->getTitle();
    }

    /**
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     *
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
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

}

?>