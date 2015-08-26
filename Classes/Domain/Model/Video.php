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
class Video extends AbstractEntity {

    /**
     *
     * @var string
     */
    protected $shortTitle;

    /**
     *
     * @var string
     */
    protected $copyright;

    /**
     * PosterImage
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference $posterImage
     */
    protected $posterImage;

    /**
     * Mp4Source
     *
     * @var string $mp4Source
     */
    protected $mp4Source = NULL;

    /**
     * WebMSource
     *
     * @var string $webMSource
     */
    protected $webMSource = NULL;

    /**
     * OggSource
     *
     * @var string $oggSource
     */
    protected $oggSource = NULL;

    /**
     * FlashSource
     *
     * @var string $flashSource
     */
    protected $flashSource = NULL;

    /**
     * height
     *
     * @var integer $height
     */
    protected $height = 240;

    /**
     * width
     *
     * @var integer $width
     */
    protected $width = 320;

    /**
     *
     * @var string
     */
    protected $alt;

    /**
     *
     * @var string
     */
    protected $longdesc;

    /**
     *
     * @var string
     */
    protected $caption;

    /**
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Subtitle>
     */
    protected $subtitles;

    /**
     *
     * @var string
     */
    protected $externalSource;

    /**
     *
     * @var string
     */
    protected $externalType = 'video/youtube';

    /**
     *
     * @var string
     */
    protected $duration = '00:00:00';

    /**
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Video>      
     */
    protected $related;

    /**
     * @var integer
     */
    protected $singlePid;

    /**
     *
     * @var \SJBR\StaticInfoTables\Domain\Model\Language
     */
    protected $staticLangIsocode;

    /**
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Video>    
     */
    protected $versions;

    /**
     *
     * @var \Ssch\SschHtml5videoplayer\Domain\Model\Video 
     */
    protected $parentid;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $images;

    /**
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>     
     */
    protected $videos;    

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
     * @return string
     */
    public function getShortTitle() {
        return $this->shortTitle;
    }

    /**
     *
     * @param string $shortTitle 
     */
    public function setShortTitle($shortTitle) {
        $this->shortTitle = $shortTitle;
    }

    /**
     *
     * @return string
     */
    public function getCopyright() {
        if ($this->copyright) {
            return $this->copyright;
        } elseif ($this->parentid instanceof \Ssch\SschHtml5videoplayer\Domain\Model\Video) {
            return $this->parentid->getCopyright();
        }
        return $this->copyright;
    }

    /**
     *
     * @param string $copyright 
     */
    public function setCopyright($copyright) {
        $this->copyright = $copyright;
    }

    /**
     * Sets the posterImage
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $posterImage
     * @return void
     */
    public function setPosterImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $posterImage) {
        $this->posterImage = $posterImage;
    }

    /**
     * Returns the posterImage
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getPosterImage() {
        if ($this->posterImage) {
            return $this->posterImage;
        } elseif ($this->parentid instanceof \Ssch\SschHtml5videoplayer\Domain\Model\Video) {
            return $this->parentid->getPosterImage();
        }
    }

    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        $this->initStorageObjects();
    }

    /**
     * @return void
     */
    protected function initStorageObjects() {
        $this->subtitles = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->related = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->versions = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->videos = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getSubtitles() {
        return $this->subtitles;
    }

    /**
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $subtitles
     */
    public function setSubtitles($subtitles) {
        $this->subtitles = $subtitles;
    }

    /**
     * Returns the height
     *
     * @return integer $height
     */
    public function getHeight() {
        if ($this->height) {
            return $this->height;
        } elseif ($this->parentid instanceof \Ssch\SschHtml5videoplayer\Domain\Model\Video) {
            return $this->parentid->getHeight();
        }
    }

    /**
     * Sets the height
     *
     * @param integer $height
     * @return void
     */
    public function setHeight($height) {
        $this->height = $height;
    }

    /**
     * Returns the width
     *
     * @return integer $width
     */
    public function getWidth() {
        if ($this->width) {
            return $this->width;
        } elseif ($this->parentid instanceof \Ssch\SschHtml5videoplayer\Domain\Model\Video) {
            return $this->parentid->getWidth();
        }
    }

    /**
     * Sets the width
     *
     * @param integer $width
     * @return void
     */
    public function setWidth($width) {
        $this->width = $width;
    }

    /**
     *
     * @return boolean
     */
    public function getHasHTML5Video() {
        return !empty($this->mp4Source) || !empty($this->oggSource) || !empty($this->webMSource) ? TRUE : FALSE;
    }

    /**
     *
     * @return string
     */
    public function getAlt() {
        return $this->alt;
    }

    /**
     *
     * @param string $alt
     */
    public function setAlt($alt) {
        $this->alt = $alt;
    }

    /**
     *
     * @return string
     */
    public function getLongdesc() {
        return $this->longdesc;
    }

    /**
     *
     * @param string $longdesc
     */
    public function setLongdesc($longdesc) {
        $this->longdesc = $longdesc;
    }

    /**
     *
     * @return string
     */
    public function getCaption() {
        return $this->caption;
    }

    /**
     *
     * @param string $caption
     */
    public function setCaption($caption) {
        $this->caption = $caption;
    }

    /**
     *
     * @return string
     */
    public function getExternalSource() {
        return $this->externalSource;
    }

    /**
     *
     * @param string $externalSource
     */
    public function setExternalSource($externalSource) {
        $this->externalSource = $externalSource;
    }

    /**
     *
     * @return string
     */
    public function getExternalType() {
        return $this->externalType;
    }

    /**
     *
     * @param string $externalType
     */
    public function setExternalType($externalType) {
        $this->externalType = $externalType;
    }

    /**
     *
     * @return string
     */
    public function getDuration() {
        if ($this->duration) {
            return $this->duration;
        } elseif ($this->parentid instanceof \Ssch\SschHtml5videoplayer\Domain\Model\Video) {
            return $this->parentid->getDuration();
        }
        return $this->duration;
    }

    /**
     *
     * @param string $duration 
     */
    public function setDuration($duration) {
        $this->duration = $duration;
    }

    /**
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Video> 
     */
    public function getRelated() {
        return $this->related;
    }

    /**
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Video> $related 
     */
    public function setRelated($related) {
        $this->related = $related;
    }

    /**
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Video> 
     */
    public function getVersions() {
        if ($this->parentid instanceof \Ssch\SschHtml5videoplayer\Domain\Model\Video) {
            return $this->getParentid()->getVersions();
        }
        if ($this->versions instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage) {
            if ($this->versions->count() > 0) {
                return array_merge(array($this), $this->versions->toArray());
            }
        }
        return NULL;
    }

    /**
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ssch\SschHtml5videoplayer\Domain\Model\Video> $versions 
     */
    public function setVersions($versions) {
        $this->versions = $versions;
    }

    /**
     *
     * @return integer
     */
    public function getSinglePid() {
        return $this->singlePid;
    }

    /**
     *
     * @param integer $singlePid 
     */
    public function setSinglePid($singlePid) {
        $this->singlePid = $singlePid;
    }

    /**
     *
     * @return \Ssch\SschHtml5videoplayer\Domain\Model\Video
     */
    public function getParentid() {
        return $this->parentid;
    }

    /**
     *
     * @param \Ssch\SschHtml5videoplayer\Domain\Model\Video $parentid 
     */
    public function setParentid($parentid) {
        $this->parentid = $parentid;
    }

    /**
     * 
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getImages() {
        if (NULL === $this->images) {
            if ($this->parentid instanceof \Ssch\SschHtml5videoplayer\Domain\Model\Video) {
                return $this->getParentid()->getImages();
            }
        }
        return $this->images;
    }

    /**
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
     */
    public function setImages($images) {
        $this->images = $images;
    }

    /**
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function getVideos() {
        return $this->videos;
    }

    /**
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $videos
     */
    public function setVideos($videos) {
        $this->videos = $videos;
    }

}
