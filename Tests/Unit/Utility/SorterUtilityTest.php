<?php

namespace Ssch\SschHtml5videoplayer\Tests\Utility;

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

class SorterUtilityTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

    /**
     *
     * @var \Ssch\SschHtml5videoplayer\Utility\SorterUtility
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new \Ssch\SschHtml5videoplayer\Utility\SorterUtility();
    }

    /**
     * @test
     */
    public function sortElementsAsDefinedInFlexFormsWithObjectStorage()
    {
        $records = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $videoMock1 = $this->getMock('Ssch\\SschHtml5videoplayer\\Domain\\Model\\Video', array('getUid'));
        $videoMock1->expects($this->any())->method('getUid')->will($this->returnValue(1));
        $videoMock2 = $this->getMock('Ssch\\SschHtml5videoplayer\\Domain\\Model\\Video', array('getUid'));
        $videoMock2->expects($this->any())->method('getUid')->will($this->returnValue(3));
        $videoMock3 = $this->getMock('Ssch\\SschHtml5videoplayer\\Domain\\Model\\Video', array('getUid'));
        $videoMock3->expects($this->any())->method('getUid')->will($this->returnValue(4));
        $videoMock4 = $this->getMock('Ssch\\SschHtml5videoplayer\\Domain\\Model\\Video', array('getUid'));
        $videoMock4->expects($this->any())->method('getUid')->will($this->returnValue(5));
        $records->attach($videoMock1);
        $records->attach($videoMock2);
        $records->attach($videoMock3);
        $records->attach($videoMock4);
        self::assertSame(array($videoMock2, $videoMock3, $videoMock1, $videoMock4),
            $this->subject->sortElementsAsDefinedInFlexForms('3,4,1,5', $records));
    }

    /**
     * @test
     */
    public function sortElementsAsDefinedInFlexFormsWithArrayOfObjects()
    {
        $video1 = new \stdClass();
        $video1->uid = 1;
        $video2 = new \stdClass();
        $video2->uid = 3;
        $video3 = new \stdClass();
        $video3->uid = 4;
        $video4 = new \stdClass();
        $video4->uid = 5;
        self::assertSame(array($video2, $video3, $video1, $video4),
            $this->subject->sortElementsAsDefinedInFlexForms('3,4,1,5', array($video1, $video2, $video3, $video4)));
    }

    /**
     * @test
     */
    public function sortElementsAsDefinedInFlexFormsWithQueryResult()
    {
        $result = $this->getAccessibleMock('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\QueryResult', array(), array(),
            '', false);
        $video1 = new \stdClass();
        $video1->uid = 1;
        $video2 = new \stdClass();
        $video2->uid = 3;
        $video3 = new \stdClass();
        $video3->uid = 4;
        $video4 = new \stdClass();
        $video4->uid = 5;
        $result->_set('queryResult', array($video2, $video3, $video1, $video4));
        self::assertSame(array($video2, $video3, $video1, $video4),
            $this->subject->sortElementsAsDefinedInFlexForms('3,4,1,5', array($video1, $video2, $video3, $video4)));
    }

    /**
     * @test
     */
    public function sortElemensAsDefinedInFlexFormsWithWrongParameter()
    {
        self::assertSame(null, $this->subject->sortElementsAsDefinedInFlexForms('3,5,4,1', '3,4,5,1'));
    }

}
