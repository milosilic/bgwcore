<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 23.1.18.
 * Time: 17.45
 */

namespace Bgw\Core;


interface IMessage
{


    public function getVersion(): int;

    public function setVersion(int $version): void;

    public function getMessage();

    public function setMessage($version): void;

}