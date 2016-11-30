<?php

namespace Ssch\SschHtml5videoplayer\Utility;

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
use Traversable;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use UnexpectedValueException;

class SorterUtility
{
    /**
     * Sort elements as defined in a CSV-List.
     *
     * @param string $definedInFlexFormsAsList
     * @param mixed $records
     * @param string $key
     * @throws SorterException
     *
     * @return array $sortedRecords
     */
    public function sortElementsAsDefinedInFlexForms($definedInFlexFormsAsList, $records, $key = 'uid')
    {
        if (! $this->areElementsValid($records)) {
            throw SorterException::createInvalidElementsException($records);
        }
        $arrayOfRecordsAsOrderedInFlexForms = GeneralUtility::trimExplode(',', $definedInFlexFormsAsList);
        $sortedRecords                      = [];
        foreach ($arrayOfRecordsAsOrderedInFlexForms as $flexFormEntryKey => $flexFormEntryValue) {
            $element = $this->sortArray($records, $flexFormEntryValue, $key);
            if (null !== $element) {
                $sortedRecords[] = $element;
            }
        }

        return $sortedRecords;
    }

    /**
     * Sort the array.
     *
     * @param mixed $records
     * @param int $num
     * @param string $key
     *
     * @return mixed|null
     */
    private function sortArray($records, $num, $key = 'uid')
    {
        foreach ($records as $record) {
            if (is_array($record)) {
                $recordUid = $record[$key];
            } elseif ($record instanceof AbstractDomainObject) {
                $recordUid = ObjectAccess::getProperty($record, $key);
            } elseif (is_object($record)) {
                $recordUid = $record->$key;
            } else {
                throw new UnexpectedValueException('It is not possible to get key of record');
            }

            if ((string)$recordUid === (string)$num) {
                return $record;
            }
        }
        return null;
    }

    /**
     * @param array|Traversable $elements
     *
     * @return bool
     */
    private function areElementsValid($elements)
    {
        if ($elements instanceof Traversable) {
            return true;
        } elseif (is_array($elements)) {
            return true;
        }

        return false;
    }
}
