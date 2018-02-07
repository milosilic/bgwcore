<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 18.9.17.
 * Time: 18.15
 */

namespace Bgw\Core;


class UnpackMapFromIni implements IUnpack
{

    // __DIR__ . "/comm-app-config.ini"

    /* @var string
     * */
    private $path;

    public function __construct($path)
    {
       $this->path = $path;
    }

    function getUnpackMap(): array
    {
        $options = parse_ini_file($this->path, true);
        return $options;
    }

    function setPathToFile(string $path)
    {
        $this->path = $path;
    }
}