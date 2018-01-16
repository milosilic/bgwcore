<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 20.9.17.
 * Time: 11.36
 */

namespace Bgw\core;


abstract class Mapper
{

    private $connection = null;

    public function __construct()
    {

//        $this->connection = $connection;
    }

    private function getFromMap($id)
    {
        return ObjectWatcher::exists(
            $this->targetClass(),
            $id
        );
    }

    private function addToMap(DomainObject $obj): DomainObject
    {
        return ObjectWatcher::add($obj);
    }

    public function findAll(IdentityObject $identity): Collection
    {

        $statement = $this->selectAllStmt($identity);
        return $this->getCollection($statement);
    }


    public function getFactory(): PersistenceFactory
    {
        return PersistenceFactory::getFactory($this->targetClass());
    }

    public function createObject(array $row): DomainObject
    {
        $objfactory = $this->getFactory()->getDomainObjectFactory();

        return $objfactory->createObject($row);
    }


    public function getCollection(array $raw): Collection
    {
        return $this->getFactory()->getCollection($raw);
    }


    public function insert(DomainObject $obj)
    {

        $this->doInsert($obj);
        $this->addToMap($obj);
        $obj->markClean();
    }

    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    public function getConnection()
    {
        return $this->connection;
    }



    abstract protected function doInsert(DomainObject $object);
    abstract protected function targetClass(): string;
    abstract protected function selectStmt();
    abstract public function selectAllStmt(IdentityObject $identityObject);
    abstract protected function getIdentity();

    //added from existing projects
    abstract protected function getSelection();

}