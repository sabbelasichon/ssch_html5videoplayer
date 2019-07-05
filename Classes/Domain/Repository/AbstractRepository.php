<?php

namespace Ssch\SschHtml5videoplayer\Domain\Repository;

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
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

abstract class AbstractRepository extends Repository
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * Finds all opjects.
     *
     * @return array|QueryResultInterface
     */
    public function findAll()
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        return $query->execute();
    }

    /**
     * Get a list of addresses.
     *
     * @param string $uids A comma separeted list of uids
     *
     * @return array|QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findByUids($uids)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->in('uid', GeneralUtility::intExplode(',', $uids)));

        return $query->execute();
    }

    public function injectCategoryService(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param string $categoryUids Comma separeted list of categories
     *
     * @return array|QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findByCategories($categoryUids)
    {
        $categories = $this->categoryService->getSubCategories($categoryUids);
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $constraints = [];
        $constraints[] = $query->in('categories.uid', $categories);
        $query->matching($query->logicalAnd($constraints));

        return $query->execute();
    }

    /**
     * @param string $orderBy
     * @param null   $orderDirection
     */
    public function setOrderings($orderBy = null, $orderDirection = null)
    {
        if (null !== $orderBy) {
            $orderDirection = $orderDirection === 'asc' ? QueryInterface::ORDER_ASCENDING : QueryInterface::ORDER_DESCENDING;
            switch ($orderBy) {
                case 'sorting':
                case 'crdate':
                case 'title':
                case 'tstamp':
                    $this->setDefaultOrderings([$orderBy => $orderDirection]);
                    break;
                default:
                    $this->setDefaultOrderings(['sorting' => $orderDirection]);
                    break;
            }
        }
    }
}
