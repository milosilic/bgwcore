<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 8.10.17.
 * Time: 08.38
 */

namespace Bgw\core\DomainObject;


use Bgw\core\DomainObject;
use Bgw\core\Mapper;
use Bgw\core\Registry;

class DomainObjectMysql extends DomainObject
{

    public function getFinder(): Mapper
    {
        $reg = Registry::instance();

        return $reg->getMysqlMapper();


    }
}