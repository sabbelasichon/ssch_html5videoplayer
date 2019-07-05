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
use Ssch\SschHtml5videoplayer\Domain\Model\Video;
use Ssch\SschHtml5videoplayer\Domain\Repository\VideoRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

class VideoController extends AbstractController
{
    /**
     * @var VideoRepository
     *
     */
    protected $videoRepository;

    /**
     * @var CategoryRepository
     *
     */
    protected $categoryRepository;

    /**
     * Displays a single Video.
     *
     * @param Video $video the Video to display
     */
    public function showAction(Video $video = null)
    {
        if (null === $video) {
            $videoUid = intval($this->settings['videoSelection']);
            $video = $this->videoRepository->findByUid($videoUid);
        }
        if (null !== $video) {
            $this->view->assign('data', $this->configurationManager->getContentObject()->data);
            $this->view->assign('video', $video);
        }
    }

    /**
     * action list.
     *
     * @param int $category
     */
    public function listAction($category = null)
    {
        $this->videoRepository->setOrderings($this->settings['orderBy'], $this->settings['orderDirection']);
        if ($this->settings['videoSelection']) {
            $videoObjects = $this->videoRepository->findByUids($this->settings['videoSelection']);
            $videos = $this->sorterUtility->sortElementsAsDefinedInFlexForms($this->settings['videoSelection'], $videoObjects);
        } elseif ($category !== null) {
            $videos = $this->videoRepository->findByCategories($category);
        } elseif ($this->settings['categories']) {
            $videos = $this->videoRepository->findByCategories($this->settings['categories']);
        } else {
            $videos = $this->videoRepository->findAll();
        }
        $this->view->assign('data', $this->configurationManager->getContentObject()->data);
        $this->view->assign('videos', $videos);
    }

    /**
     * @param ViewInterface $view
     */
    protected function initializeView(ViewInterface $view)
    {
        // Set template
        if ($this->settings['templateFile']) {
            $templateFile = GeneralUtility::getFileAbsFileName($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_sschhtml5videoplayer.']['view.']['templateRootPath'] . 'Video/' . $this->settings['templateFile']);
            if (file_exists($templateFile)) {
                $view->setTemplatePathAndFilename($templateFile);
            }
        }
    }

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function injectCategoryRepository(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param VideoRepository $videoRepository
     */
    public function injectVideoRepository(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }
}
