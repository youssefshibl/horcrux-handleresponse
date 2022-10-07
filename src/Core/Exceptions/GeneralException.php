<?php

namespace Horcrux\Handleresponse\Core\Exceptions;

class GeneralException
{
    public static function push_exption($ex)
    {
        $code = $ex->getCode();
        $message = $ex->getMessage();
        $file = $ex->getFile();
        $line = $ex->getLine();
        echo "Exception thrown in $file on line $line: [Code $code] $message";
    }
}
