<?php

namespace Ssch\SschHtml5videoplayer\Controller;

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

use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

class VideoController extends AbstractController {

    /**
     *
     * @var \Ssch\SschHtml5videoplayer\Domain\Repository\VideoRepository
     * @inject
     */
    protected $videoRepository = NULL;

    /**
     * Displays a single Video
     *
     * @param \Ssch\SschHtml5videoplayer\Domain\Model\Video $video the Video to display
     * @return string The rendered view
     */
    public function showAction(\Ssch\SschHtml5videoplayer\Domain\Model\Video $video = NULL) {
        if (NULL === $video) {
            $videoUid = intval($this->settings['videoSelection']);
            $video = $this->videoRepository->findByUid($videoUid);
        }
        if (NULL !== $video) {
            if (\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($this->settings['videoWidth']) && \TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($this->settings['videoHeight'])) {
                $video->setTempWidth($this->settings['videoWidth']);
                $video->setTempHeight($this->settings['videoHeight']);
            }
            $this->view->assign('video', $video);
        }
    }

    /**
     * action list
     *
     * @return string The rendered list action
     */
    public function listAction() {
        if ($this->settings['videoSelection']) {
            $videos = $this->videoRepository->findByUids($this->settings['videoSelection']);
            $videos = $this->sorterUtility->sortElementsAsDefinedInFlexForms($this->settings['videoSelection'], $videos);
        } else {
            $videos = $this->videoRepository->findAll();
        }
        $this->view->assign('videos', $videos);
    }

    /**
     * 
     * @param \Ssch\SschHtml5videoplayer\Controller\ViewInterface $view
     */
    protected function initializeView(ViewInterface $view) {
        // Set template
        if ($this->settings['templateFile']) {
            $templateFile = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_sschhtml5videoplayer.']['view.']['templateRootPath'] . 'Video/' . $this->settings['templateFile']);
            if (TRUE === file_exists($templateFile)) {
                $view->setTemplatePathAndFilename($templateFile);
            }
        }
    }

}

?>