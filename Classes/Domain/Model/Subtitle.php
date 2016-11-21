<?php

namespace Ssch\SschHtml5videoplayer\Domain\Model;

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
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

class Subtitle extends AbstractEntity
{
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $track;

    /**
     * @var \SJBR\StaticInfoTables\Domain\Model\Language
     */
    protected $staticLangIsocode;

    /**
     * @var bool
     */
    protected $selected;

    /**
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getTrack()
    {
        return $this->track;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $track
     */
    public function setTrack(FileReference $track)
    {
        $this->track = $track;
    }

    /**
     * @return \SJBR\StaticInfoTables\Domain\Model\Language
     */
    public function getStaticLangIsocode()
    {
        return $this->staticLangIsocode;
    }

    /**
     * @param \SJBR\StaticInfoTables\Domain\Model\Language $staticLangIsocode
     */
    public function setStaticLangIsocode($staticLangIsocode)
    {
        $this->staticLangIsocode = $staticLangIsocode;
    }

    /**
     * @return bool
     */
    public function getSelected()
    {
        return $this->selected;
    }

    /**
     * @param bool $selected
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->getTrack()->getOriginalResource()->getPublicUrl();
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->getTrack()->getOriginalResource()->getExtension();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTrack();
    }
}
