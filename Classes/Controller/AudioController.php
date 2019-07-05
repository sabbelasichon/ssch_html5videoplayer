<?php

namespace Ssch\SschHtml5videoplayer\Controller;

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
use Ssch\SschHtml5videoplayer\Domain\Model\Audio;
use Ssch\SschHtml5videoplayer\Domain\Repository\AudioRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

class AudioController extends AbstractController
{
    /**
     * @var AudioRepository
     *
     */
    protected $audioRepository = null;

    /**
     * Displays a single Audio.
     *
     * @param \Ssch\SschHtml5videoplayer\Domain\Model\Audio $audio the audio to play
     */
    public function showAction(Audio $audio = null)
    {
        if (null === $audio) {
            $audioUid = intval($this->settings['audioSelection']);
            $audio = $this->audioRepository->findByUid($audioUid);
        }
        $this->view->assign('data', $this->configurationManager->getContentObject()->data);
        $this->view->assign('audio', $audio);
    }

    /**
     * Display a list of audio files.
     */
    public function listAction()
    {
        $this->audioRepository->setOrderings($this->settings['orderBy'], $this->settings['orderDirection']);
        if ($this->settings['audioSelection']) {
            $audios = $this->audioRepository->findByUids($this->settings['audioSelection']);
            $audios = $this->sorterUtility->sortElementsAsDefinedInFlexForms($this->settings['audioSelection'],
                $audios);
        } else {
            $audios = $this->audioRepository->findAll();
        }
        $this->view->assign('data', $this->configurationManager->getContentObject()->data);
        $this->view->assign('audios', $audios);
    }

    /**
     * @param ViewInterface $view
     */
    protected function initializeView(ViewInterface $view)
    {
        // Set template
        if ($this->settings['templateFile']) {
            $templateFile = GeneralUtility::getFileAbsFileName($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_sschhtml5videoplayer.']['view.']['templateRootPath'] . 'Audio/' . $this->settings['templateFile']);
            if (file_exists($templateFile)) {
                $view->setTemplatePathAndFilename($templateFile);
            }
        }
    }

    /**
     * @param AudioRepository $audioRepository
     */
    public function injectAudioRepository(AudioRepository $audioRepository)
    {
        $this->audioRepository = $audioRepository;
    }
}
