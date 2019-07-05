<?php

namespace Ssch\SschHtml5videoplayer\Controller;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class CategoryController extends ActionController
{
    /**
     * @var CategoryRepository
     *
     */
    protected $categoryRepository;

    /**
     * @var CategoryService
     *
     */
    protected $categoryService;

    /**
     * @param Category $category
     */
    public function filterAction(Category $category = null)
    {
        $this->view->assign('categories', $this->getCategories());
        $this->view->assign('category', $category);
        $controller = 'Video';
        $this->view->assign('controller', $controller);
    }

    /**
     * @return array|QueryResultInterface
     */
    protected function getCategories()
    {
        $categories = $this->categoryService->getSubCategories($this->settings['categories']);
        $categories = GeneralUtility::removeArrayEntryByValue($categories, $this->settings['categories']);
        $query = $this->categoryRepository->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $constraints = [];
        $constraints[] = $query->in('uid', $categories);
        $query->matching($query->logicalAnd($constraints));

        return $query->execute();
    }

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function injectCategoryRepository(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param CategoryService $categoryService
     */
    public function injectCategoryService(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
}
