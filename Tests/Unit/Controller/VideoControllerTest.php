<?php

namespace Ssch\SschHtml5videoplayer\Tests\Unit\Controller;

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
use Nimut\TestingFramework\TestCase\UnitTestCase;
use Ssch\SschHtml5videoplayer\Controller\VideoController;
use Ssch\SschHtml5videoplayer\Domain\Model\Video;
use Ssch\SschHtml5videoplayer\Domain\Repository\VideoRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class VideoControllerTest extends UnitTestCase
{
    /**
     * @var VideoController
     */
    protected $subject;

    /**
     */
    public function setUp()
    {
        $this->subject = $this->getAccessibleMock(VideoController::class,
            ['redirect', 'forward', 'addFlashMessage'], [], '', false);
    }

    /**
     * @test
     */
    public function showAction()
    {
        $settings = ['settings'];
        $data = ['data'];

        $videoMock = $this->getMock(Video::class);
        $contentObject = new \stdClass();
        $contentObject->data = $data;
        $this->inject($this->subject, 'settings', $settings);

        $videoRepositoryMock = $this->getMock(VideoRepository::class,
            ['findByUid'], [], '', false);
        $videoRepositoryMock->expects($this->once())->method('findByUid')->will($this->returnValue($videoMock));
        $this->inject($this->subject, 'videoRepository', $videoRepositoryMock);

        $view = $this->getMock(ViewInterface::class);
        $view->expects($this->at(0))->method('assign')->with('data', $data);
        $view->expects($this->at(1))->method('assign')->with('video', $videoMock);
        $this->inject($this->subject, 'view', $view);

        $configurationManagerMock = $this->getMock(ConfigurationManagerInterface::class, [], [], '', false);
        $configurationManagerMock->expects($this->once())->method('getContentObject')->will($this->returnValue($contentObject));
        $this->inject($this->subject, 'configurationManager', $configurationManagerMock);

        $this->subject->showAction();
    }

    /**
     * @test
     */
    public function listAction()
    {
        $allVideos = $this->getMock(ObjectStorage::class, [], [], '', false);

        $settings = ['settings'];
        $data = ['data'];

        $contentObject = new \stdClass();
        $contentObject->data = $data;
        $this->inject($this->subject, 'settings', $settings);

        $videoRepositoryMock = $this->getMock(VideoRepository::class,
            ['findAll'], [], '', false);
        $videoRepositoryMock->expects($this->once())->method('findAll')->will($this->returnValue($allVideos));
        $this->inject($this->subject, 'videoRepository', $videoRepositoryMock);

        $configurationManagerMock = $this->getMock(ConfigurationManagerInterface::class, [], [], '', false);
        $configurationManagerMock->expects($this->once())->method('getContentObject')->will($this->returnValue($contentObject));
        $this->inject($this->subject, 'configurationManager', $configurationManagerMock);

        $view = $this->getMock(ViewInterface::class);
        $view->expects($this->at(0))->method('assign')->with('data', $data);
        $view->expects($this->at(1))->method('assign')->with('videos', $allVideos);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }
}
