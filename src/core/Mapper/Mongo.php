<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 21.9.17.
 * Time: 16.53
 */

namespace bgw\core\Mapper;


use Bgw\core\DomainObject;
use Bgw\core\IdentityObject;
use Bgw\core\IdentityObject\IdentityObjectMongo;
use Bgw\core\Mapper;
use Bgw\core\SelectionFactory\SelectionFactoryMongo;
use Bgw\core\SelectionFactoryMysql;

class Mongo extends Mapper
{
    private $collection;

    public function __construct($connection, string $collection)
    {
        //parent::__construct($connection);
        $this->setConnection($connection);
        $this->collection = $collection;
    }

    protected function doInsert(DomainObject $object)
    {
        // TODO: Implement doInsert() method.
    }

    protected function targetClass(): string
    {
        // TODO: Implement targetClass() method.
    }

    // ovo ce biti findOne recimo, u produkcionoj verziji
    protected function selectStmt()
    {
        $connection = $this->getConnection();
        $collection = $connection->{$this->collection};
        //fale argumenti
        return $collection->findAll();

    }

    public function selectAllStmt(IdentityObject $identityObject): \PDOStatement
    {
        // TODO: Implement selectAllStmt() method.
    }


    public function findOne(IdentityObjectMongo $identity){
        $connection = $this->getConnection();
        $collection = $connection->{$this->collection};

        return $collection->findOne($this->getSelection()->where($identity));

    }

    public function getIdentity()
    {
        return new IdentityObjectMongo();
    }


    protected function getSelection()
    {
        return new SelectionFactoryMongo();
    }
}