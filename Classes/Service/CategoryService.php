<?php

namespace Ssch\SschHtml5videoplayer\Service;

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
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CategoryService implements SingletonInterface
{
    /**
     * @param string $categoryUids
     *
     * @return array
     */
    public function getSubCategories($categoryUids)
    {
        $categories = GeneralUtility::trimExplode(',', $categoryUids);
        foreach ($categories as $category) {
            $subCategoriesList = $this->getTreeListOfAnyTable($category);
            if ($subCategoriesList) {
                $categories = array_merge($categories, GeneralUtility::trimExplode(',', $subCategoriesList));
            }
        }

        return array_unique($categories);
    }

    /**
     * @param int    $id
     * @param int    $depth
     * @param int    $begin
     * @param int    $perms_clause
     * @param string $table
     * @param string $field
     * @param string $fields
     *
     * @return string Comma seperated list of uids
     */
    public function getTreeListOfAnyTable($id, $depth = 99, $begin = 0, $perms_clause = 1, $table = 'sys_category', $field = 'parent', $fields = 'uid')
    {
        $depth = intval($depth);
        $begin = intval($begin);
        $id = intval($id);
        if ($begin == 0) {
            $theList = $id;
        } else {
            $theList = '';
        }
        if ($id && $depth > 0) {
            $res = $this->getDatabaseConnection()->exec_SELECTquery(
                    $fields, $table, $field . '=' . $id . ' ' . BackendUtility::deleteClause($table) . ' AND ' . $perms_clause
            );
            while ($row = $this->getDatabaseConnection()->sql_fetch_assoc($res)) {
                if ($begin <= 0) {
                    $theList .= ',' . $row['uid'];
                }
                if ($depth > 1) {
                    $theList .= $this->getTreeListOfAnyTable($row['uid'], $depth - 1, $begin - 1, $perms_clause, $table, $field, $fields);
                }
            }
        }

        return $theList;
    }

    /**
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}
