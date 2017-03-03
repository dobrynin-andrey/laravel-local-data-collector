<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 26.08.16
 * Time: 17:56
 */

namespace RonasIT\Support\LocalDataCollector\Exceptions;

use Exception;

class MissedProductionFilePathException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct(
            "Production file path missed in config.",
            $code, $previous);
    }
}