<?php

namespace Ssch\SschHtml5videoplayer\Domain\Repository;

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
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

abstract class AbstractRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     *
     * @var \Ssch\SschHtml5videoplayer\Service\CategoryService
     * @inject
     */
    protected $categoryService;

    /**
     * Finds all opjects
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @internal param null $orderBy
     */
    public function findAll()
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        return $query->execute();
    }

    /**
     * Get a list of addresses
     * @param string $uids A comma separeted list of uids
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByUids($uids)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->in('uid', GeneralUtility::intExplode(',', $uids)));

        return $query->execute();
    }

    /**
     *
     * @param string $categoryUids Comma separeted list of categories
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByCategories($categoryUids)
    {
        $categories = $this->categoryService->getSubCategories($categoryUids);
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $constraints = array();
        $constraints[] = $query->in('categories.uid', $categories);
        $query->matching($query->logicalAnd($constraints));

        return $query->execute();
    }

    /**
     * @param string $orderBy
     * @param null $orderDirection
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
                    $this->setDefaultOrderings(array($orderBy => $orderDirection));
                    break;
                default:
                    $this->setDefaultOrderings(array('sorting' => $orderDirection));
                    break;
            }
        }
    }


}
