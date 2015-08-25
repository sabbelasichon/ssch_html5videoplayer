<?php

namespace Ssch\SschHtml5videoplayer\Tests\Unit\Controller;

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
class AudioControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

    /**
     *
     * @var \Ssch\SschHtml5videoplayer\Controller\AudioController
     */
    protected $subject;

    /**
     * @return void
     */
    public function setUp() {
        $this->subject = $this->getAccessibleMock('Ssch\\SschHtml5videoplayer\\Controller\\AudioController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
    }

    /**
     * @test
     */
    public function showAction() {
        $settings = array('settings');
        $data = array('data');

        $audioMock = $this->getMock('Ssch\\SschHtml5videoplayer\\Domain\\Model\\Audio');
        $contentObject = new \stdClass();
        $contentObject->data = $data;
        $this->inject($this->subject, 'settings', $settings);

        $audioRepositoryMock = $this->getMock('Ssch\\SschHtml5videoplayer\\Domain\\Repository\\AudioRepository', array('findByUid'), array(), '', FALSE);
        $audioRepositoryMock->expects($this->once())->method('findByUid')->will($this->returnValue($audioMock));
        $this->inject($this->subject, 'audioRepository', $audioRepositoryMock);

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $view->expects($this->at(0))->method('assign')->with('data', $data);
        $view->expects($this->at(1))->method('assign')->with('audio', $audioMock);
        $this->inject($this->subject, 'view', $view);

        $configurationManagerMock = $this->getMock('TYPO3\CMS\\Extbase\\Configuration\\ConfigurationManager', array('getContentObject', 'getConfiguration'), array(), '', FALSE);
        $configurationManagerMock->expects($this->once())->method('getContentObject')->will($this->returnValue($contentObject));
        $this->inject($this->subject, 'configurationManager', $configurationManagerMock);

        $this->subject->showAction();
    }

    /**
     * @test
     */
    public function listAction() {

        $allAudios = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

        $settings = array('settings');
        $data = array('data');

        $contentObject = new \stdClass();
        $contentObject->data = $data;
        $this->inject($this->subject, 'settings', $settings);

        $audioRepositoryMock = $this->getMock('Ssch\\SschHtml5videoplayer\\Domain\\Repository\\AudioRepository', array('findAll'), array(), '', FALSE);
        $audioRepositoryMock->expects($this->once())->method('findAll')->will($this->returnValue($allAudios));
        $this->inject($this->subject, 'audioRepository', $audioRepositoryMock);

        $configurationManagerMock = $this->getMock('TYPO3\CMS\\Extbase\\Configuration\\ConfigurationManager', array('getContentObject', 'getConfiguration'), array(), '', FALSE);
        $configurationManagerMock->expects($this->once())->method('getContentObject')->will($this->returnValue($contentObject));
        $this->inject($this->subject, 'configurationManager', $configurationManagerMock);

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $view->expects($this->at(0))->method('assign')->with('data', $data);
        $view->expects($this->at(1))->method('assign')->with('audios', $allAudios);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

}
