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

use TYPO3\CMS\Core\Resource\ResourceFactory;

abstract class AbstractEntity extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

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
    protected $description;

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * 
     * @param string $file
     * @return string
     */
    protected function getFile($file) {
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::isFirstPartOfStr($file, 'file:')) {
            list($identifier, $fileUid) = \TYPO3\CMS\Core\Utility\GeneralUtility::revExplode(':', $file, 2);
            if (\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($fileUid)) {
                return ResourceFactory::getInstance()->getFileObject($fileUid)->getPublicUrl();
            }
        }
        return $file;
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

}