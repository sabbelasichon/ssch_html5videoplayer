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

class Audio extends AbstractVideoAudioEntity
{
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $audioSource;

    /**
     * image.
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image;

    /**
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getAudioSource()
    {
        return $this->audioSource;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $audioSource
     */
    public function setAudioSource(FileReference $audioSource)
    {
        $this->audioSource = $audioSource;
    }

    /**
     * Returns the image.
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image.
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function setImage(FileReference $image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->audioSource->getOriginalResource()->getPublicUrl();
    }
}
