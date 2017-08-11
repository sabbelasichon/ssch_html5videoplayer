<?php

namespace Ssch\SschHtml5videoplayer\Updates;

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
use RuntimeException;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Resource\StorageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Install\Updates\AbstractUpdate;

abstract class AbstractLinksToFileReferences extends AbstractUpdate
{

    /**
     * @var ResourceFactory
     */
    protected $fileFactory;

    /**
     * @var ResourceStorage
     */
    protected $storage;

    /**
     * @var FileRepository
     */
    protected $fileRepository;

    /**
     * Initialize all required repository and factory objects.
     *
     * @throws \RuntimeException
     */
    protected function init()
    {
        $fileadminDirectory = rtrim($GLOBALS['TYPO3_CONF_VARS']['BE']['fileadminDir'], '/') . '/';
        /** @var $storageRepository StorageRepository */
        $storageRepository = GeneralUtility::makeInstance(StorageRepository::class);
        $storages          = $storageRepository->findAll();
        foreach ($storages as $storage) {
            $storageRecord = $storage->getStorageRecord();
            $configuration = $storage->getConfiguration();
            $isLocalDriver = $storageRecord['driver'] === 'Local';
            $isOnFileadmin = ! empty($configuration['basePath']) && GeneralUtility::isFirstPartOfStr($configuration['basePath'],
                    $fileadminDirectory);
            if ($isLocalDriver && $isOnFileadmin) {
                $this->storage = $storage;
                break;
            }
        }
        if (! isset($this->storage)) {
            throw new RuntimeException('Local default storage could not be initialized - might be due to missing sys_file* tables.');
        }
        $this->fileRepository = GeneralUtility::makeInstance(FileRepository::class);
        $this->fileFactory    = GeneralUtility::makeInstance(ResourceFactory::class);
    }

    /**
     * @param string $description
     *
     * @return bool
     */
    public function checkForUpdate(&$description)
    {
        $fieldsToUpdate = $this->findFieldsToUpdate();
        if (! empty($fieldsToUpdate)) {
            foreach ($fieldsToUpdate as $fieldToUpdate) {
                $count = $this->getDatabaseConnection()->exec_SELECTcountRows('uid', $this->getTable(),
                    $this->getDatabaseConnection()->quoteStr($fieldToUpdate, $this->getTable()) . ' != ""');
                if ($count) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @return string
     */
    abstract protected function getTable();

    /**
     * @param $oldFieldname
     *
     * @return string
     */
    abstract protected function findFieldnameForFileReferenceRelation($oldFieldname);

    /**
     * @return array
     */
    abstract protected function findFieldsToUpdate();

    /**
     * @param array $dbQueries
     * @param mixed $customMessages
     *
     * @return bool
     */
    public function performUpdate(array &$dbQueries, &$customMessages)
    {
        $this->init();
        $fieldsToUpdate = $this->findFieldsToUpdate();

        $sorting = 1;
        foreach ($fieldsToUpdate as $fieldToUpdate) {
            $rows = $this->getDatabaseConnection()->exec_SELECTgetRows('*', $this->getTable(),
                $this->getDatabaseConnection()->quoteStr($fieldToUpdate, $this->getTable()) . ' != ""');
            if (! empty($rows)) {
                foreach ($rows as $row) {
                    $this->migrateField($row, $fieldToUpdate, $sorting);
                    $this->updateRelation($row, $fieldToUpdate);
                }
            }
            $sorting++;
        }

        return true;
    }

    /**
     * @param array $row
     * @param string $fieldToUpdate
     */
    protected function updateRelation(array $row, $fieldToUpdate)
    {
        $counter = $row[$this->findFieldnameForFileReferenceRelation($fieldToUpdate)];
        if (!MathUtility::canBeInterpretedAsInteger($counter)) {
            $counter = 0;
        }
        ++$counter;
        $this->getDatabaseConnection()->exec_UPDATEquery($this->getTable(), 'uid = ' . (int)$row['uid'], [$this->findFieldnameForFileReferenceRelation($fieldToUpdate) => $counter]);
    }

    /**
     * @param array $row
     * @param $fieldToUpdate
     * @param int $sorting
     */
    protected function migrateField(array $row, $fieldToUpdate, $sorting)
    {
        try {
            $fileObject = $this->fileFactory->getFileObjectFromCombinedIdentifier($row[$fieldToUpdate]);
        } catch (\Exception $e) {
            $fileObject = null;
        }
        if ($fileObject instanceof File) {
            $this->fileRepository->add($fileObject);
            $dataArray = [
                'uid_local'        => $fileObject->getUid(),
                'tablenames'       => $this->getTable(),
                'fieldname'        => $this->findFieldnameForFileReferenceRelation($fieldToUpdate),
                'uid_foreign'      => $row['uid'],
                'table_local'      => 'sys_file',
                'cruser_id'        => 999,
                'pid'              => $row['pid'],
                'sorting_foreign'  => $sorting,
                'hidden'           => $row['hidden'],
                'sys_language_uid' => 0,
            ];

            $this->getDatabaseConnection()->exec_INSERTquery('sys_file_reference', $dataArray);
        }
    }

    /**
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}
