<?php

namespace Ssch\SschHtml5videoplayer\Domain\Repository;

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

abstract class AbstractRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

    /**
     * Finds all opjects
     *
     * @return object  All objects
     */
    public function findAll() {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        return $query->execute();
    }

    /**
     * Get a list of addresses
     * @param string $uids A comma separeted list of uids
     * @return Tx_Extbase_Persistence_QueryResultInterface
     */
    public function findByUids($uids) {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $query->matching($query->in('uid', \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(',', $uids)));
        return $query->execute();
    }

}
