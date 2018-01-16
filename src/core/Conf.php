<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 15.9.17.
 * Time: 14.35
 */

namespace Bgw\core;

class Conf
{
    private $vals = [];

    public function __construct(array $vals = [])
    {
        $this->vals = $vals;
    }

    public function get(string $key)
    {
        if (isset($this->vals[$key])) {
            return $this->vals[$key];
        }
        return null;
    }

    public function set(string $key, $val)
    {
        $this->vals[$key] = $val;
    }
}
