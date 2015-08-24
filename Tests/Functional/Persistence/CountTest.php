<?php

namespace Ssch\SschHtml5videoplayer\Tests\Functional\Persistence;

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
use \TYPO3\CMS\Core\Utility\GeneralUtility;

class CountTest extends \TYPO3\CMS\Core\Tests\FunctionalTestCase {

    /**
     *
     * @var \Ssch\SschHtml5videoplayer\Domain\Repository\VideoRepository
     */
    protected $videoRepository;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface The object manager
     */
    protected $objectManager;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    protected $persistentManager;

    /**
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->importDataSet(ORIGINAL_ROOT . 'typo3conf/ext/ssch_html5videoplayer/Tests/Functional/Persistence/Fixtures/videos.xml');

        $this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $this->persistentManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $this->videoRepository = $this->objectManager->get('Ssch\SschHtml5videoplayer\\Domain\\Repository\\VideoRepository');
    }

    /**
     * @test
     */
    public function countAll() {
        $this->videoRepository->countAll();
    }

}
