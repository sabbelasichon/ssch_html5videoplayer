<?php

namespace Ssch\SschHtml5videoplayer\Tests\Service;

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
use Ssch\SschHtml5videoplayer\Service\CategoryService;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class CategoryServiceTest extends UnitTestCase
{
    /**
     * @test
     */
    public function getSubCategories()
    {
        $categoryServiceMock = $this->getMock(CategoryService::class, ['getTreeListOfAnyTable']);
        /* @var $categoryServiceMock \PHPUnit_Framework_MockObject_MockObject|CategoryService */
        $categoryServiceMock->expects($this->any())->method('getTreeListOfAnyTable')->will($this->returnValue(100));

        $categoriesExpected = ['1', '2', '3', '100'];
        $categoriesActual = $categoryServiceMock->getSubCategories('1,2,3');
        sort($categoriesActual, SORT_NUMERIC);
        self::assertSame($categoriesExpected, $categoriesActual);
    }
}
