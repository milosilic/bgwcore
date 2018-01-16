<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 8.10.17.
 * Time: 08.31
 */

namespace bgw\core\DomainObjectFactory;


use Bgw\core\DomainObject;
use Bgw\core\DomainObject\DomainObjectMysql;
use Bgw\core\DomainObjectFactory;

class DomainObjectFactoryMysql extends DomainObjectFactory
{

    public function createObject(array $row): DomainObject
    {
        $obj  = new DomainObjectMysql($row['id']);
        $obj->setData($row);
        return $obj;
    }
}