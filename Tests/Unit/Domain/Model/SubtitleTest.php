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
use SJBR\StaticInfoTables\Domain\Model\Language;
use Ssch\SschHtml5videoplayer\Domain\Model\Subtitle;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

class SubtitleTest extends UnitTestCase
{
    /**
     * @var Subtitle
     */
    protected $subject = null;

    /**
     */
    public function setUp()
    {
        $this->subject = new Subtitle();
    }

    /**
     * @test
     */
    public function getAndSetSelected()
    {
        $this->subject->setSelected(true);
        self::assertTrue($this->subject->getSelected());
    }

    /**
     * @test
     */
    public function getAndSetTrack()
    {
        $trackMock = $this->getMock(FileReference::class);
        $this->subject->setTrack($trackMock);
        self::assertSame($trackMock, $this->subject->getTrack());
    }

    /**
     * @test
     */
    public function getAndSetLanguageIsoCode()
    {
        $staticLangIsocode = $this->getMockBuilder(Language::class)->getMock();
        $this->subject->setStaticLangIsocode($staticLangIsocode);
        self::assertInstanceOf(Language::class, $this->subject->getStaticLangIsocode());
    }
}
