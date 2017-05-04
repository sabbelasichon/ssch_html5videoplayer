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
class VideoLinksToFileReferences extends AbstractLinksToFileReferences
{

    const TABLE = 'tx_sschhtml5videoplayer_domain_model_video';

    /**
     * @var string
     */
    protected $title = 'Migrate video relations of EXT:ssch_html5videoplayer';

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
        if (false !== array_search($oldFieldname, ['mp4_source', 'web_m_source', 'ogg_source', 'flash_source'])) {
            return 'videos';
        }
        return $oldFieldname;
    }

    /**
     * @return array
     */
    protected function findFieldsToUpdate()
    {
        $videoTableFields = $this->getDatabaseConnection()->admin_get_fields($this->getTable());
        $fieldsToUpdate   = ['mp4_source', 'poster_image', 'web_m_source', 'ogg_source', 'flash_source'];

        return array_intersect($fieldsToUpdate, array_keys($videoTableFields));
    }
}
