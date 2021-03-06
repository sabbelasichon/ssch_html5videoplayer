<?php

namespace Ssch\SschHtml5videoplayer\Tests\Unit\ViewHelpers;

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
use Nimut\TestingFramework\TestCase\ViewHelperBaseTestcase;
use Ssch\SschHtml5videoplayer\Domain\Model\Video;
use Ssch\SschHtml5videoplayer\ViewHelpers\VideoViewHelper;

class VideoViewHelperTest extends ViewHelperBaseTestcase
{

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|\TYPO3\CMS\Fluid\Core\ViewHelper\TagBuilder
     */
    protected $tagBuilder;

    /**
     * @var VideoViewHelper
     */
    protected $viewHelper;

    /**
     */
    public function setUp()
    {
        parent::setUp();
        $this->tagBuilder = $this->getMock('TYPO3\\CMS\\Fluid\\Core\\ViewHelper\\TagBuilder');
        $this->viewHelper = $this->getAccessibleMock(VideoViewHelper::class, ['renderChildren']);
        $this->injectDependenciesIntoViewHelper($this->viewHelper);
        $this->viewHelper->initializeArguments();
    }

    /**
     * @test
     */
    public function renderProvidesVideoTagWithWithAndHeightFromSettings()
    {
        $this->tagBuilder->expects($this->once())->method('forceClosingTag')->with(true);
        $this->tagBuilder->expects($this->once())->method('render');
        $this->tagBuilder->expects($this->once())->method('setContent');
        $this->tagBuilder->expects($this->exactly(3))->method('addAttribute')->withConsecutive(
            [$this->equalTo('width'), $this->equalTo(300)],
            [$this->equalTo('height'), $this->equalTo(150)],
            [$this->equalTo('class'), $this->equalTo('mejs-skin')]
        );

        $settings = [
            'videoWidth' => 300,
            'videoHeight' => 150,
            'skin' => 'mejs-skin'
        ];
        $video = $this->getMock(Video::class, ['getHeight', 'getWidth']);
        $video->expects($this->any())->method('getHeight')->will($this->returnValue(100));
        $video->expects($this->any())->method('getWidth')->will($this->returnValue(100));

        $this->viewHelper->initialize();
        $this->viewHelper->render($settings, $video);
    }

    /**
     * @test
     */
    public function renderProvidesVideoTagWithWidthFromSettingsAndHeightFromVideo()
    {
        $this->tagBuilder->expects($this->once())->method('forceClosingTag')->with(true);
        $this->tagBuilder->expects($this->once())->method('render');
        $this->tagBuilder->expects($this->once())->method('setContent');
        $this->tagBuilder->expects($this->exactly(2))->method('addAttribute')->withConsecutive(
            [$this->equalTo('width'), $this->equalTo(300)],
            [$this->equalTo('height'), $this->equalTo(300)]
        );

        $settings = [
            'videoWidth' => 300,
        ];
        $video = $this->getMock(Video::class, ['getHeight', 'getWidth']);
        $video->expects($this->any())->method('getHeight')->will($this->returnValue(100));
        $video->expects($this->any())->method('getWidth')->will($this->returnValue(100));

        $this->viewHelper->initialize();
        $this->viewHelper->render($settings, $video);
    }

    /**
     * @test
     */
    public function renderProvidesVideoTagWithHeightFromSettingsAndWidthFromVideo()
    {
        $this->tagBuilder->expects($this->once())->method('forceClosingTag')->with(true);
        $this->tagBuilder->expects($this->once())->method('render');
        $this->tagBuilder->expects($this->once())->method('setContent');
        $this->tagBuilder->expects($this->exactly(2))->method('addAttribute')->withConsecutive(
            [$this->equalTo('width'), $this->equalTo(300)],
            [$this->equalTo('height'), $this->equalTo(300)]
        );

        $settings = [
            'videoWidth' => 300,
        ];
        $video = $this->getMock(Video::class, ['getHeight', 'getWidth']);
        $video->expects($this->any())->method('getHeight')->will($this->returnValue(100));
        $video->expects($this->any())->method('getWidth')->will($this->returnValue(100));

        $this->viewHelper->initialize();
        $this->viewHelper->render($settings, $video);
    }

    /**
     * @test
     */
    public function renderProvidesVideoTagWithWidthAndHeightFromVideo()
    {
        $this->tagBuilder->expects($this->once())->method('forceClosingTag')->with(true);
        $this->tagBuilder->expects($this->once())->method('render');
        $this->tagBuilder->expects($this->once())->method('setContent');
        $this->tagBuilder->expects($this->exactly(2))->method('addAttribute')->withConsecutive(
            [$this->equalTo('width'), $this->equalTo(100)],
            [$this->equalTo('height'), $this->equalTo(100)]
        );

        $settings = [];
        $video    = $this->getMock(Video::class, ['getHeight', 'getWidth']);
        $video->expects($this->any())->method('getHeight')->will($this->returnValue(100));
        $video->expects($this->any())->method('getWidth')->will($this->returnValue(100));

        $this->viewHelper->initialize();
        $this->viewHelper->render($settings, $video);
    }

    /**
     * @test
     */
    public function renderProvidesVideoTagWithWidthAndHeightFromDefaultSettings()
    {
        $this->tagBuilder->expects($this->once())->method('forceClosingTag')->with(true);
        $this->tagBuilder->expects($this->once())->method('render');
        $this->tagBuilder->expects($this->once())->method('setContent');
        $this->tagBuilder->expects($this->exactly(3))->method('addAttribute')->withConsecutive(
            [$this->equalTo('width'), $this->equalTo(300)],
            [$this->equalTo('height'), $this->equalTo(150)],
            [$this->equalTo('class'), $this->equalTo('mejs-skin')]
        );

        $settings = [
            'video' => [
                'defaultWidth' => 300,
                'defaultHeight' => 150,
            ],
            'skin' => 'mejs-skin'
        ];

        $video = $this->getMock(Video::class, ['getHeight', 'getWidth']);
        $video->expects($this->any())->method('getHeight')->will($this->returnValue(0));
        $video->expects($this->any())->method('getWidth')->will($this->returnValue(0));

        $this->viewHelper->initialize();
        $this->viewHelper->render($settings, $video);
    }

    /**
     * @test
     */
    public function renderProvidesCorrectVideoTagOutput()
    {
        $this->tagBuilder->expects($this->once())->method('render')->will($this->returnValue('<video width="100" height="100">'));

        $settings = [];
        $video    = $this->getMock(Video::class, ['getHeight', 'getWidth']);
        $video->expects($this->any())->method('getHeight')->will($this->returnValue(100));
        $video->expects($this->any())->method('getWidth')->will($this->returnValue(100));

        $this->viewHelper->initialize();
        self::assertSame('<video width="100" height="100">', $this->viewHelper->render($settings, $video));
    }
}
