<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 8.10.17.
 * Time: 08.31
 */

namespace Bgw\Core\DomainObjectFactory;


use Bgw\Core\DomainObject;
use Bgw\Core\DomainObject\DomainObjectMysql;
use Bgw\Core\DomainObjectFactory;

class DomainObjectFactoryMysql extends DomainObjectFactory
{

    public function createObject(array $row): DomainObject
    {
        $obj  = new DomainObjectMysql($row['id']);
        $obj->setData($row);
        return $obj;
    }
}