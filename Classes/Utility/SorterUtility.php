<?php

namespace Ssch\SschHtml5videoplayer\Utility;

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

class SorterUtility {

    /**
     * Sort elements as defined in a CSV-List
     * @param string $definedInFlexFormsAsList
     * @param mixed $records
     * @param string $key
     * @return array $sortedRecords
     */
    public function sortElementsAsDefinedInFlexForms($definedInFlexFormsAsList, $records, $key = 'uid') {
        if ($this->areElementsValid($records)) {
            $arrayOfRecordsAsOrderedInFlexForms = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $definedInFlexFormsAsList);
            $sortedRecords = array();
            foreach ($arrayOfRecordsAsOrderedInFlexForms as $flexFormEntryKey => $flexFormEntryValue) {
                $element = $this->sortArray($records, $flexFormEntryValue, $key);
                if($element !== NULL) {
                    $sortedRecords[] = $element;
                }
            }
            return $sortedRecords;
        }
        return NULL;
    }

    /**
     * Sort the array
     * @param mixed $records
     * @param integer $num
     * @param string $key
     * @return array
     */
    protected function sortArray($records, $num, $key = 'uid') {
        foreach ($records as $record) {
            if (is_array($record)) {
                $recordUid = $record[$key];
            } elseif ($record instanceof \TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject) {
                $recordUid = \TYPO3\CMS\Extbase\Reflection\ObjectAccess::getProperty($record, $key);               
            } elseif (is_object($record)) {
                $recordUid = $record->$key;
            }
           
            if ((string) $recordUid === (string) $num) {
                return $record;
            }
        }
        return;
    }
    
    /**
     * @elements array
     */
    protected function areElementsValid($elements) {
        if ($elements instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage) {
            return TRUE;
        } elseif ($elements instanceof \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult) {
            return TRUE;
        } elseif (is_array($elements)) {
            return TRUE;
        }
        return FALSE;
    }

}
