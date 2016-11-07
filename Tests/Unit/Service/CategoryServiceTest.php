<?php

namespace Ssch\SschHtml5videoplayer\Tests\Service;

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

class CategoryServiceTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

    /**
     * @test
     */
    public function getSubCategories()
    {
        $categoryServiceMock = $this->getMock('Ssch\\SschHtml5videoplayer\\Service\\CategoryService',
            array('getTreeListOfAnyTable'));
        /* @var $categoryServiceMock \Ssch\SschHtml5videoplayer\Service\CategoryService */
        $categoryServiceMock->expects($this->any())->method('getTreeListOfAnyTable')->will($this->returnValue(100));

        $categoriesExpected = array('1', '2', '3', '100');
        $categoriesActual = $categoryServiceMock->getSubCategories('1,2,3');
        sort($categoriesActual, SORT_NUMERIC);
        self::assertSame($categoriesExpected, $categoriesActual);
    }

}
