<?php

namespace Ssch\SschHtml5videoplayer\ViewHelpers;

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
use Ssch\SschHtml5videoplayer\Domain\Model\Video;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class VideoViewHelper extends AbstractTagBasedViewHelper
{
    /**
     * name of the tag to be created by this viewhelper.
     *
     * @var string
     *
     * @api
     */
    protected $tagName = 'video';

    /**
     * Initialize the arguments.
     *
     * @api
     */
    public function initializeArguments()
    {
        $this->registerTagAttribute('preload', 'string', 'Preload video', false);
        $this->registerTagAttribute('controls', 'string', 'Controls of video', false);
        $this->registerTagAttribute('rel', 'string', 'Rel attribute for the nivo-slider', false);
        $this->registerTagAttribute('poster', 'string', 'The poster image of the video', false);
        $this->registerUniversalTagAttributes();
    }

    /**
     * Render content of video tag.
     *
     * @param array $settings   The settings array
     * @param Video $video      The video object
     * @param bool  $responsive
     *
     * @return string
     */
    public function render(array $settings, Video $video, $responsive = false)
    {
        $this->tag->forceClosingTag(true);
        if (false === $responsive) {

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
