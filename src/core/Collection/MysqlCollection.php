<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 8.10.17.
 * Time: 08.46
 */

namespace bgw\core\Collection;


use Bgw\core\Collection;

class MysqlCollection extends Collection
{

    public function targetClass(): string
    {
        return Mysql::class;
    }
}