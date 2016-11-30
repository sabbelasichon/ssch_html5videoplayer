<?php

namespace Ssch\SschHtml5videoplayer\Tests\Utility;

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
use Ssch\SschHtml5videoplayer\Utility\SorterUtility;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class SorterUtilityTest extends UnitTestCase
{
    /**
     * @var SorterUtility
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new SorterUtility();
    }

    /**
     * @test
     */
    public function sortElementsAsDefinedInFlexFormsWithObjectStorage()
    {
        $records = new ObjectStorage();
        $videoMock1 = $this->getMock(Video::class, ['getUid']);
        $videoMock1->expects($this->any())->method('getUid')->will($this->returnValue(1));
        $videoMock2 = $this->getMock(Video::class, ['getUid']);
        $videoMock2->expects($this->any())->method('getUid')->will($this->returnValue(3));
        $videoMock3 = $this->getMock(Video::class, ['getUid']);
        $videoMock3->expects($this->any())->method('getUid')->will($this->returnValue(4));
        $videoMock4 = $this->getMock(Video::class, ['getUid']);
        $videoMock4->expects($this->any())->method('getUid')->will($this->returnValue(5));
        $records->attach($videoMock1);
        $records->attach($videoMock2);
        $records->attach($videoMock3);
        $records->attach($videoMock4);
        self::assertSame([$videoMock2, $videoMock3, $videoMock1, $videoMock4],
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
        self::assertSame([$video2, $video3, $video1, $video4],
            $this->subject->sortElementsAsDefinedInFlexForms('3,4,1,5', [$video1, $video2, $video3, $video4]));
    }

    /**
     * @test
     */
    public function sortElementsAsDefinedInFlexFormsWithQueryResult()
    {
        $result = $this->getAccessibleMock(QueryResult::class, [], [], '', false);
        $video1 = new \stdClass();
        $video1->uid = 1;
        $video2 = new \stdClass();
        $video2->uid = 3;
        $video3 = new \stdClass();
        $video3->uid = 4;
        $video4 = new \stdClass();
        $video4->uid = 5;
        $result->_set('queryResult', [$video2, $video3, $video1, $video4]);
        self::assertSame([$video2, $video3, $video1, $video4],
            $this->subject->sortElementsAsDefinedInFlexForms('3,4,1,5', [$video1, $video2, $video3, $video4]));
    }

    /**
     * @test
     * @expectedException \Ssch\SschHtml5videoplayer\Utility\SorterException
     */
    public function sortElementsAsDefinedInFlexFormsWithWrongParameter()
    {
        self::assertSame(null, $this->subject->sortElementsAsDefinedInFlexForms('3,5,4,1', '3,4,5,1'));
    }
}
