<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 30.9.17.
 * Time: 20.10
 */

namespace Bgw\core;


class AppException extends \Exception
{
    public function __construct(string $msg = "", int $code = 0, \Exception $previous = null)
    {
        parent::__construct($msg, $code, $previous);
    }
}
