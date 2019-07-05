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
use Ssch\SschHtml5videoplayer\Controller\AudioController;
use Ssch\SschHtml5videoplayer\Domain\Model\Audio;
use Ssch\SschHtml5videoplayer\Domain\Repository\AudioRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class AudioControllerTest extends UnitTestCase
{
    /**
     * @var AudioController
     */
    protected $subject;

    /**
     */
    public function setUp()
    {
        $this->subject = $this->getAccessibleMock(
            AudioController::class,
            ['redirect', 'forward', 'addFlashMessage'],
            [],
            '',
            false
        );
    }

    /**
     * @test
     */
    public function showAction()
    {
        $settings = ['settings'];
        $data = ['data'];

        $audioMock = $this->getMock(Audio::class);
        $contentObject = new \stdClass();
        $contentObject->data = $data;
        $this->inject($this->subject, 'settings', $settings);

        $audioRepositoryMock = $this->getMock(AudioRepository::class, ['findByUid'], [], '', false);
        $audioRepositoryMock->expects($this->once())->method('findByUid')->will($this->returnValue($audioMock));
        $this->inject($this->subject, 'audioRepository', $audioRepositoryMock);

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $view->expects($this->at(0))->method('assign')->with('data', $data);
        $view->expects($this->at(1))->method('assign')->with('audio', $audioMock);
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
        $allAudios = $this->getMock(ObjectStorage::class, [], [], '', false);

        $settings = ['settings'];
        $data = ['data'];

        $contentObject = new \stdClass();
        $contentObject->data = $data;
        $this->inject($this->subject, 'settings', $settings);

        $audioRepositoryMock = $this->getMock(AudioRepository::class, ['findAll'], [], '', false);
        $audioRepositoryMock->expects($this->once())->method('findAll')->will($this->returnValue($allAudios));
        $this->inject($this->subject, 'audioRepository', $audioRepositoryMock);

        $configurationManagerMock = $this->getMock(ConfigurationManagerInterface::class, [], [], '', false);
        $configurationManagerMock->expects($this->once())->method('getContentObject')->will($this->returnValue($contentObject));
        $this->inject($this->subject, 'configurationManager', $configurationManagerMock);

        $view = $this->getMock(ViewInterface::class);
        $view->expects($this->at(0))->method('assign')->with('data', $data);
        $view->expects($this->at(1))->method('assign')->with('audios', $allAudios);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }
}
