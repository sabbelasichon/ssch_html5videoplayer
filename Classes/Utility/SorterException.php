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
use RuntimeException;

class SorterException extends RuntimeException
{

    /**
     * @param $elements
     *
     * @return static
     */
    public static function createInvalidElementsException($elements)
    {
        $message = sprintf('The given elements are of type %s. This is not allowed to be sorted.', gettype($elements));

        return new static($message);
    }
}
