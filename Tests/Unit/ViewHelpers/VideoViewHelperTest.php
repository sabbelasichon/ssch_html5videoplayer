<?php

namespace Ssch\SschHtml5videoplayer\Tests\Unit\ViewHelpers;

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
class VideoViewHelperTest extends \TYPO3\CMS\Fluid\Tests\Unit\ViewHelpers\ViewHelperBaseTestcase {

    /**
     *
     * @var \Ssch\SschHtml5videoplayer\ViewHelpers\VideoViewHelper
     */
    protected $viewHelper;

    /**
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->viewHelper = $this->getAccessibleMock('Ssch\\SschHtml5videoplayer\\ViewHelpers\\VideoViewHelper');
        $this->injectDependenciesIntoViewHelper($this->viewHelper);
        $this->viewHelper->initializeArguments();        
    }

    /**
     * @test
     */
    public function renderProvidesVideoTag() {
        $this->tagBuilder->expects($this->once())->method('forceClosingTag')->with(TRUE);
        $this->tagBuilder->expects($this->once())->method('render');
        $this->tagBuilder->expects($this->once())->method('setContent');


        $settings = array();
        $settings['videoWidth'] = 300;
        $settings['videoHeight'] = 150;
        $video = new \Ssch\SschHtml5videoplayer\Domain\Model\Video();
        $video->setHeight(100);
        $video->setWidth(100);
        
        $this->viewHelper->initialize();
        $this->viewHelper->render($settings, $video);        
    }

}
