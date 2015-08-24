<?php

namespace Ssch\SschHtml5videoplayer\Tests\Unit\Domain\Model;

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
class AbstractEntityTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

    /**
     *
     * @var \Ssch\SschHtml5videoplayer\Domain\Model\AbstractEntity
     */
    protected $subject = NULL;

    /**
     * @return void
     */
    public function setUp() {
        $this->subject = $this->getMockForAbstractClass('Ssch\\SschHtml5videoplayer\\Domain\\Model\\AbstractEntity');
    }

    /**
     * @test
     */
    public function setTitle() {
        $this->subject->setTitle('Anything');
        self::assertSame('Anything', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function setDescription() {
        $this->subject->setDescription('Anything');
        self::assertSame('Anything', $this->subject->getDescription());
    }

}
