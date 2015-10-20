<?php

namespace Ssch\SschHtml5videoplayer\UserFuncs;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Sebastian Schreiber <me@schreibersebastian.de>, Sebastian Schreiber
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

class Labels {

    /**
     *
     * @param array $params
     * @return void
     */
    public function getLabel(&$params) {

        if ($this->isNew($params)) {
            return TRUE;
        }
        switch ($params['table']) {
            case 'tx_sschhtml5videoplayer_domain_model_video':
                $row = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('video1.title AS title, video2.title AS title2, sl.lg_name_en AS language', $params['table'] . ' AS video1 LEFT JOIN tx_sschhtml5videoplayer_domain_model_video AS video2 ON video2.uid = video1.parentid LEFT JOIN static_languages AS sl ON sl.uid = video1.static_lang_isocode', 'video1.uid = ' . intval($params['row']['uid']));
                $parts = array();
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
            default:
                return TRUE;
                break;
        }
    }

    /**
     *
     * @param array $params
     * @return boolean 
     */
    protected function isNew($params) {
        if (FALSE !== strpos($params['row']['uid'], 'NEW')) {
            return TRUE;
        }
        return FALSE;
    }

}