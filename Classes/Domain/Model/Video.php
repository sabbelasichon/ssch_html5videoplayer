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

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

class Video extends AbstractVideoAudioEntity
{
    /**
     * @var string
     */
    protected $shortTitle;

    /**
     * @var string
     */
    protected $copyright;

    /**
     * PosterImage.
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $posterImage;

    /**
     * Mp4Source.
     *
     * @var string
     */
    protected $mp4Source = null;

    /**
     * WebMSource.
     *
     * @var string
     */
    protected $webMSource = null;

    /**
     * OggSource.
     *
     * @var string
     */
    protected $oggSource = null;

    /**
     * FlashSource.
     *
     * @var string
     */
    protected $flashSource = null;

    /**
     * height.
     *
     * @var int
     */
    protected $height = 240;

    /**
     * width.
     *
     * @var int
     */
    protected $width = 320;

    /**
     * @var string
     */
    protected $alt;

    /**
     * @var string
     */
    protected $longdesc;

    /**
     * @var string
     */
    protected $caption;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Subtitle>
     */
    protected $subtitles;

    /**
     * @var string
     */
    protected $externalSource;

    /**
     * @var string
     */
    protected $externalType = 'video/youtube';

    /**
     * @var string
     */
    protected $duration = '00:00:00';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Video>
     */
    protected $related;

    /**
     * @var int
     */
    protected $singlePid;

    /**
     * @var \SJBR\StaticInfoTables\Domain\Model\Language
     */
    protected $staticLangIsocode;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Video>
     */
    protected $versions;

    /**
     * @var \Ssch\SschHtml5videoplayer\Domain\Model\Video
     */
    protected $parentid;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $images;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $videos;

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
     * @return string
     */
    public function getShortTitle()
    {
        return $this->shortTitle;
    }

    /**
     * @param string $shortTitle
     */
    public function setShortTitle($shortTitle)
    {
        $this->shortTitle = $shortTitle;
    }

    /**
     * @return string
     */
    public function getCopyright()
    {
        if ($this->copyright) {
            return $this->copyright;
        } elseif ($this->parentid instanceof self) {
            return $this->parentid->getCopyright();
        }

        return $this->copyright;
    }

    /**
     * @param string $copyright
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;
    }

    /**
     * Sets the posterImage.
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $posterImage
     */
    public function setPosterImage(FileReference $posterImage)
    {
        $this->posterImage = $posterImage;
    }

    /**
     * Returns the posterImage.
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getPosterImage()
    {
        if ($this->posterImage) {
            return $this->posterImage;
        } elseif ($this->parentid instanceof self) {
            return $this->parentid->getPosterImage();
        }

        return;
    }

    /**
     * Video constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->subtitles = new ObjectStorage();
        $this->related = new ObjectStorage();
        $this->versions = new ObjectStorage();
        $this->videos = new ObjectStorage();
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getSubtitles()
    {
        return $this->subtitles;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $subtitles
     */
    public function setSubtitles($subtitles)
    {
        $this->subtitles = $subtitles;
    }

    /**
     * Returns the height.
     *
     * @return int $height
     */
    public function getHeight()
    {
        if ($this->height) {
            return $this->height;
        } elseif ($this->parentid instanceof self) {
            return $this->parentid->getHeight();
        }

        return 0;
    }

    /**
     * Sets the height.
     *
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Returns the width.
     *
     * @return int $width
     */
    public function getWidth()
    {
        if ($this->width) {
            return $this->width;
        } elseif ($this->parentid instanceof self) {
            return $this->parentid->getWidth();
        }

        return 0;
    }

    /**
     * Sets the width.
     *
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return bool
     */
    public function getHasHTML5Video()
    {
        return !empty($this->mp4Source) || !empty($this->oggSource) || !empty($this->webMSource) ? true : false;
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

    /**
     * @return string
     */
    public function getLongdesc()
    {
        return $this->longdesc;
    }

    /**
     * @param string $longdesc
     */
    public function setLongdesc($longdesc)
    {
        $this->longdesc = $longdesc;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    /**
     * @return string
     */
    public function getExternalSource()
    {
        return $this->externalSource;
    }

    /**
     * @param string $externalSource
     */
    public function setExternalSource($externalSource)
    {
        $this->externalSource = $externalSource;
    }

    /**
     * @return string
     */
    public function getExternalType()
    {
        return $this->externalType;
    }

    /**
     * @param string $externalType
     */
    public function setExternalType($externalType)
    {
        $this->externalType = $externalType;
    }

    /**
     * @return string
     */
    public function getDuration()
    {
        if ($this->duration) {
            return $this->duration;
        } elseif ($this->parentid instanceof self) {
            return $this->parentid->getDuration();
        }

        return $this->duration;
    }

    /**
     * @param string $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Video>
     */
    public function getRelated()
    {
        return $this->related;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Video> $related
     */
    public function setRelated($related)
    {
        $this->related = $related;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Video>
     */
    public function getVersions()
    {
        if ($this->parentid instanceof self) {
            return $this->getParentid()->getVersions();
        }
        if ($this->versions instanceof ObjectStorage) {
            if ($this->versions->count() > 0) {
                return array_merge(array($this), $this->versions->toArray());
            }
        }

        return;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Video> $versions
     */
    public function setVersions($versions)
    {
        $this->versions = $versions;
    }

    /**
     * @return int
     */
    public function getSinglePid()
    {
        return $this->singlePid;
    }

    /**
     * @param int $singlePid
     */
    public function setSinglePid($singlePid)
    {
        $this->singlePid = $singlePid;
    }

    /**
     * @return \Ssch\SschHtml5videoplayer\Domain\Model\Video
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * @param \Ssch\SschHtml5videoplayer\Domain\Model\Video $parentid
     */
    public function setParentid($parentid)
    {
        $this->parentid = $parentid;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getImages()
    {
        if (null === $this->images) {
            if ($this->parentid instanceof self) {
                return $this->getParentid()->getImages();
            }
        }

        return $this->images;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $videos
     */
    public function setVideos($videos)
    {
        $this->videos = $videos;
    }
}
