<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 18.9.17.
 * Time: 18.13
 */

namespace Bgw\Core;


interface IUnpack
{
    function getUnpackMap():array;

    function setPathToFile(string $path);
}