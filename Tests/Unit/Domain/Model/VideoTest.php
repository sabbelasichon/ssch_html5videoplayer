<?php

namespace Ssch\SschHtml5videoplayer\Tests\Unit\Domain\Model;

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
use Ssch\SschHtml5videoplayer\Domain\Model\Video;

class VideoTest extends UnitTestCase
{
    /**
     * @var \Ssch\SschHtml5videoplayer\Domain\Model\Video
     */
    protected $subject = null;

    /**
     */
    public function setUp()
    {
        $this->subject = new Video();
    }

    /**
     * @test
     */
    public function defaultExternalTypeIsYoutube()
    {
        self::assertSame('video/youtube', $this->subject->getExternalType());
    }

    /**
     * @test
     */
    public function setAndGetExternalType()
    {
        $this->subject->setExternalType('anything');
        self::assertSame('anything', $this->subject->getExternalType());
    }

    /**
     * @test
     */
    public function setAndGetCopyrightFromParentVideo()
    {
        $parentVideo = new Video();
        $parentVideo->setCopyright('Copyright from parent video');
        $this->subject->setParentid($parentVideo);
        self::assertSame('Copyright from parent video', $this->subject->getCopyright());
    }
}
