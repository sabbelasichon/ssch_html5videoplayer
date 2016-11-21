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
use Ssch\SschHtml5videoplayer\Domain\Model\Audio;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

class AudioTest extends UnitTestCase
{
    /**
     * @var Audio
     */
    protected $subject = null;

    /**
     */
    public function setUp()
    {
        $this->subject = new Audio();
    }

    /**
     * @test
     */
    public function getAndSetImage()
    {
        $image = $this->getMock(FileReference::class);
        $this->subject->setImage($image);
        self::assertInstanceOf(FileReference::class, $this->subject->getImage());
    }
}
