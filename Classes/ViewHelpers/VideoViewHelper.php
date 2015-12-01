<?php

namespace Ssch\SschHtml5videoplayer\ViewHelpers;

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

class VideoViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {

    /**
     * name of the tag to be created by this view helper
     *
     * @var string
     * @api
     */
    protected $tagName = 'video';

    /**
     * Initialize the arguments.
     *
     * @return void
     * @api
     */
    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerTagAttribute('preload', 'string', 'Preload video', FALSE);
        $this->registerTagAttribute('controls', 'string', 'Controls of video', FALSE);
        $this->registerTagAttribute('rel', 'string', 'Rel attribute for the nivo-slider', FALSE);
        $this->registerTagAttribute('poster', 'string', 'The poster image of the video', FALSE);
        $this->registerUniversalTagAttributes();
    }

    /**
     * Render content of video tag
     * @param array $settings The settings array
     * @param \Ssch\SschHtml5videoplayer\Domain\Model\Video $video The video object
     * @param boolean $responsive
     * @return string
     */
    public function render(array $settings, \Ssch\SschHtml5videoplayer\Domain\Model\Video $video, $responsive = FALSE) {
        $this->tag->forceClosingTag(TRUE);
        if (FALSE === $responsive) {

            // The width and height cascade: settings, video, default
            $settingsVideoWidth = $settings['videoWidth'] ? $settings['videoWidth'] : $settings['video']['defaultWidth'];
            $settingsVideoHeight = $settings['videoHeight'] ? $settings['videoHeight'] : $settings['video']['defaultHeight'];
            $videoWidth = $video->getWidth() ? $video->getWidth() : $settingsVideoWidth;
            $videoHeight = $video->getHeight() ? $video->getHeight() : $settingsVideoHeight;

            if ($videoWidth > $videoHeight) {
                $videoRatio = $videoHeight / $videoWidth;
            } else {
                $videoRatio = $videoWidth / $videoHeight;
            }

            if ($settings['videoWidth'] > 0 && $settings['videoHeight'] > 0) {
                $videoWidth = $settingsVideoWidth;
                $videoHeight = $settingsVideoHeight;
            } elseif ($settings['videoWidth'] > 0) {
                $videoWidth = $settingsVideoWidth;
                $videoHeight = $videoWidth * $videoRatio;
            } elseif ($settings['videoHeight'] > 0) {
                $videoHeight = $settingsVideoHeight;
                $videoWidth = $videoHeight * $videoRatio;
            }

            $this->tag->addAttribute('width', floor($videoWidth));
            $this->tag->addAttribute('height', floor($videoHeight));
        }
        if ($video->getPosterImage()) {
            $this->tag->addAttribute('poster', $video->getPosterImage()->getOriginalResource()->getPublicUrl());
        }
        if ($settings['skin']) {
            $this->tag->addAttribute('class', $settings['skin']);
        }

        $this->tag->setContent($this->renderChildren());
        return $this->tag->render();
    }

}
