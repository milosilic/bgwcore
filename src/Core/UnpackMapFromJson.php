<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 19.9.17.
 * Time: 10.06
 */

namespace Bgw\Core;


class UnpackMapFromJson implements IUnpack
{

    // __DIR__ . "/comm-app-config.json"

    /* @var string
     * */
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    function getUnpackMap(): array
    {
        return json_decode(file_get_contents($this->path), true);
    }

    function setPathToFile(string $path)
    {
       $this->path = $path;
    }
}