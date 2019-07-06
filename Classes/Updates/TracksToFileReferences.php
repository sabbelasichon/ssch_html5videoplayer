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
class TracksToFileReferences extends AbstractLinksToFileReferences
{
    const TABLE = 'tx_sschhtml5videoplayer_domain_model_subtitle';

    /**
     * @var string
     */
    protected $title = 'Migrate subtitle relations of EXT:ssch_html5videoplayer';

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
        if ($oldFieldname === 'track') {
            return 'track';
        }
        return $oldFieldname;
    }

    /**
     * @return array
     */
    protected function findFieldsToUpdate()
    {
        $subtitleTableFields = $this->getDatabaseConnection()->admin_get_fields($this->getTable());
        $fieldsToUpdate   = ['track'];

        return array_intersect($fieldsToUpdate, array_keys($subtitleTableFields));
    }
}
