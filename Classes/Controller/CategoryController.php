<?php

namespace Ssch\SschHtml5videoplayer\Controller;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;

class CategoryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     *
     * @var \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository;

    /**
     *
     * @var \Ssch\SschHtml5videoplayer\Service\CategoryService
     * @inject
     */
    protected $categoryService;

    /**
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
     * @return void
     */
    public function filterAction(\TYPO3\CMS\Extbase\Domain\Model\Category $category = NULL) {
        $this->view->assign('categories', $this->getCategories());
        $this->view->assign('category', $category);
        $controller = 'Video';
        $this->view->assign('controller', $controller);
    }

    /**
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    protected function getCategories() {
        $categories = $this->categoryService->getSubCategories($this->settings['categories']);
        $categories = GeneralUtility::removeArrayEntryByValue($categories, $this->settings['categories']);
        $query = $this->categoryRepository->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $constraints = array();
        $constraints[] = $query->in('uid', $categories);
        $query->matching($query->logicalAnd($constraints));
        return $query->execute();
    }

}
