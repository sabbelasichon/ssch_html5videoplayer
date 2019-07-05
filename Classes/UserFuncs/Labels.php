<?php

namespace Ssch\SschHtml5videoplayer\UserFuncs;

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
class Labels
{
    /**
     * @param array $params
     *
     * @return bool
     */
    public function getLabel(&$params)
    {
        if ($this->isNew($params)) {
            return true;
        }
        switch ($params['table']) {
            case 'tx_sschhtml5videoplayer_domain_model_video':
                $row = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
                    'video1.title AS title, video2.title AS title2, sl.lg_name_en AS language',
                    $params['table'] . ' AS video1 LEFT JOIN tx_sschhtml5videoplayer_domain_model_video AS video2 ON video2.uid = video1.parentid LEFT JOIN static_languages AS sl ON sl.uid = video1.static_lang_isocode',
                    'video1.uid = ' . intval($params['row']['uid'])
                );
                $parts = [];
                if ($row[0]['title']) {
                    $parts[] = $row[0]['title'];
                }
                if ($row[0]['language']) {
                    $parts[] = '(' . $row[0]['language'] . ')';
                }
                if ($row[0]['title2']) {
                    $parts[] = '(Elterndatensatz: ' . $row[0]['title2'] . ')';
                }
                $params['title'] = implode(' ', $parts);
                break;
        }

        return true;
    }

    /**
     * @param array $params
     *
     * @return bool
     */
    protected function isNew($params)
    {
        if (false !== strpos($params['row']['uid'], 'NEW')) {
            return true;
        }

        return false;
    }
}
