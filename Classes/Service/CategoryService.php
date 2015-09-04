<?php

namespace Ssch\SschHtml5videoplayer\Service;

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Sebastian Schreiber <ssch@hauptweg-nebenwege.de>, HauptwegNebenwege GmbH
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

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CategoryService implements \TYPO3\CMS\Core\SingletonInterface {

    /**
     * 
     * @param string $categoryUids
     * @return array
     */
    public function getSubCategories($categoryUids) {
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
     *
     * @param integer $id
     * @param integer $depth
     * @param integer $begin
     * @param string $perms_clause
     * @param string $table
     * @param string $field
     * @param string $fields
     * @return string Comma seperated list of uids
     */
    public function getTreeListOfAnyTable($id, $depth = 99, $begin = 0, $perms_clause = 1, $table = 'sys_category', $field = 'parent', $fields = 'uid') {
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
     * 
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected function getDatabaseConnection() {
        return $GLOBALS['TYPO3_DB'];
    }

}
