<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 6.10.17.
 * Time: 13.08
 */

namespace Bgw\Core;


use Bgw\Core\Collection\MysqlCollection;
use Bgw\Core\DomainObjectFactory\DomainObjectFactoryMysql;
use Bgw\Core\SelectionFactory\SelectionFactoryMysql;

class PersistenceFactoryMysql extends PersistenceFactory
{

    public function getSelectionFactory(): SelectionFactory
    {
        return new SelectionFactoryMysql();
    }


    public function getMapper(): Mapper
    {

    }

    public function getDomainObjectFactory(): DomainObjectFactory
    {
        return new DomainObjectFactoryMysql();
    }

    public function getCollection(array $raw): Collection
    {
        return new MysqlCollection($raw, $this->getDomainObjectFactory());
    }
}