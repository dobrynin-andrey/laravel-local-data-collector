<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 26.08.16
 * Time: 17:56
 */

namespace RonasIT\Support\LocalDataCollector\Exceptions;

use Exception;

class CannotFindTemporaryFileException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        $message = $message ?? "Cannot find temporary file. Please check destination path and config";
        parent::__construct($message, $code, $previous);
    }
}