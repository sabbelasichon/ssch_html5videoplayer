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

class Subtitle extends AbstractEntity {

    /**
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $track;

    /**
     *
     * @var \SJBR\StaticInfoTables\Domain\Model\Language
     */
    protected $staticLangIsocode;

    /**
     *
     * @var boolean
     */
    protected $selected;

    /**
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getTrack() {
        return $this->track;
    }

    /**
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $track
     */
    public function setTrack(\TYPO3\CMS\Extbase\Domain\Model\FileReference $track) {
        $this->track = $track;
    }

    /**
     *
     * @return \SJBR\StaticInfoTables\Domain\Model\Language
     */
    public function getStaticLangIsocode() {
        return $this->staticLangIsocode;
    }

    /**
     *
     * @param \SJBR\StaticInfoTables\Domain\Model\Language $staticLangIsocode
     */
    public function setStaticLangIsocode($staticLangIsocode) {
        $this->staticLangIsocode = $staticLangIsocode;
    }

    /**
     *
     * @return boolean
     */
    public function getSelected() {
        return $this->selected;
    }

    /**
     *
     * @param boolean $selected
     */
    public function setSelected($selected) {
        $this->selected = $selected;
    }

    /**
     * 
     * @return string
     */
    public function __toString() {
        return $this->getTrack();
    }

    /**
     * 
     * @return string
     */
    public function getUrl() {
        return $this->getTrack()->getOriginalResource()->getPublicUrl();
    }

    /**
     * 
     * @return string
     */
    public function getExtension() {
        return $this->getTrack()->getOriginalResource()->getExtension();
    }

}
