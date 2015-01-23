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

/**
 * Controller for the Audio object
 */
class AudioController extends AbstractController {

    /**
     *
     * @var \Ssch\SschHtml5videoplayer\Domain\Repository\AudioRepository
     * @inject
     */
    protected $audioRepository = NULL;

    /**
     * Displays a single Audio
     *
     * @param \Ssch\SschHtml5videoplayer\Domain\Model\Audio $audio the audio to play
     * @return string The rendered view
     */
    public function showAction(\Ssch\SschHtml5videoplayer\Domain\Model\Audio $audio = NULL) {
        if (NULL === $audio) {
            $audioUid = intval($this->settings['audioSelection']);
            $audio = $this->audioRepository->findByUid($audioUid);
        }
        $this->view->assign('audio', $audio);
    }

    /**
     * action list
     *
     * @return string The rendered list action
     */
    public function listAction() {
        $this->view->assign('audios', $this->audioRepository->findAll());
    }

}

?>