<?php

namespace Ssch\SschHtml5videoplayer\Index;

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
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\Index\ExtractorInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class MetadataExtractor implements ExtractorInterface
{
    /**
     * Returns an array of supported file types;
     * An empty array indicates all filetypes.
     *
     * @return array
     */
    public function getFileTypeRestrictions()
    {
        return [];
    }

    /**
     * Get all supported DriverClasses
     * Since some extractors may only work for local files, and other extractors
     * are especially made for grabbing data from remote.
     * Returns array of string with driver names of Drivers which are supported,
     * If the driver did not register a name, it's the classname.
     * empty array indicates no restrictions.
     *
     * @return array
     */
    public function getDriverRestrictions()
    {
        return [];
    }

    /**
     * Returns the data priority of the extraction Service.
     * Defines the precedence of Data if several extractors
     * extracted the same property.
     * Should be between 1 and 100, 100 is more important than 1.
     *
     * @return int
     */
    public function getPriority()
    {
        return 100;
    }

    /**
     * Returns the execution priority of the extraction Service
     * Should be between 1 and 100, 100 means runs as first service, 1 runs at last service.
     *
     * @return int
     */
    public function getExecutionPriority()
    {
        return 1;
    }

    /**
     * Checks if the given file can be processed by this Extractor.
     *
     * @param File $file
     *
     * @return bool
     */
    public function canProcess(File $file)
    {
        return true;
    }

    /**
     * The actual processing TASK
     * Should return an array with database properties for sys_file_metadata to write.
     *
     * @param File  $file
     * @param array $previousExtractedData optional, contains the array of already extracted data
     *
     * @return array
     */
    public function extractMetaData(File $file, array $previousExtractedData = [])
    {
        $metaData = [];

        $getId3Engine = new \getID3();
        $fileInfo = $getId3Engine->analyze($file->getStorage()->getFileForLocalProcessing($file));

        if (isset($fileInfo['playtime_seconds'])) {
            $metaData['duration'] = (float) $fileInfo['playtime_seconds'];
        }
        if (isset($fileInfo['video'])) {
            if (isset($fileInfo['video']['resolution_x'])) {
                $metaData['width'] = (integer) $fileInfo['video']['resolution_x'];
            }
            if (isset($fileInfo['video']['resolution_y'])) {
                $metaData['height'] = (integer) $fileInfo['video']['resolution_y'];
            }
        }
        GeneralUtility::devLog('Metadata extracted for file ' . $file->getName(), 'ssch_html5videoplayer', 4, $metaData);

        return $metaData;
    }
}
