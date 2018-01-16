<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 8.10.17.
 * Time: 08.38
 */

namespace Bgw\Core\DomainObject;


use Bgw\Core\DomainObject;
use Bgw\Core\Mapper;
use Bgw\Core\Registry;

class DomainObjectMysql extends DomainObject
{

    public function getFinder(): Mapper
    {
        $reg = Registry::instance();

        return $reg->getMysqlMapper();


    }
}