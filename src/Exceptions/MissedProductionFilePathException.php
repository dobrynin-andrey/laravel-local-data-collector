<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 26.08.16
 * Time: 17:56
 */

namespace RonasIT\Support\DataCollectors\Exceptions;

use Exception;

class MissedProductionFilePathException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        $message = $message ?? "Production file path missed in config.";
        parent::__construct($message, $code, $previous);
    }
}