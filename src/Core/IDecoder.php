<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 18.9.17.
 * Time: 13.28
 */

namespace Bgw\Core;


interface IDecoder
{
    function decode(array $message, IUnpack $codec):IMessage;

}