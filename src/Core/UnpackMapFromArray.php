<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 14.2.18.
 * Time: 19.32
 */

namespace Bgw\Core;


class UnpackMapFromArray implements IUnpack
{

    // __DIR__ . "/comm-app-config.ini"

    /* @var string
     * */
    private $path;

    function getUnpackMap(): array
    {
        return require ($this->path);
    }

    function setPathToFile(string $path)
    {
        $this->path = $path;
    }
}