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

class AudioLinksToFileReferences extends AbstractLinksToFileReferences
{

    const TABLE = 'tx_sschhtml5videoplayer_domain_model_audio';

    /**
     * @var string
     */
    protected $title = 'Migrate audio relations of EXT:ssch_html5videoplayer';

    /**
     * @return string
     */
    protected function getTable()
    {
        return self::TABLE;
    }


    /**
     * @param $oldFieldname
     *
     * @return string
     */
    protected function findFieldnameForFileReferenceRelation($oldFieldname)
    {
        return 'audio_source';
    }

    /**
     * @return array
     */
    protected function findFieldsToUpdate()
    {
        return array_intersect(['audio_source'],
            array_keys($this->getDatabaseConnection()->admin_get_fields($this->getTable())));
    }
}
