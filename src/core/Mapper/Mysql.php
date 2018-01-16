<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 21.9.17.
 * Time: 10.46
 */

namespace Bgw\core\Mapper;


use Bgw\core\DomainObject;
use Bgw\core\IdentityObject;
use Bgw\core\IdentityObject\IdentityObjectMysql;
use Bgw\core\Mapper;
use Bgw\core\SelectionFactory\SelectionFactoryMysql;

class Mysql extends Mapper
{
    private $selectStmt;
    private $selectAllStmt;
    private $updateStmt;
    private $insertStmt;

    private $table_name;

    public function __construct(\PDO $connection, string $table_name)
    {


        $this->setConnection($connection);

        $this->table_name = $table_name;

//        $this->selectAllStmt = $this->connnection->prepare(
//            "SELECT * FROM venue"
//        );
//        $this->selectStmt = $this->connnection->prepare(
//            "SELECT * FROM venue WHERE id=?"
//        );
//        $this->updateStmt = $this->connnection->prepare(
//            "UPDATE venue SET name=?, id=? WHERE id=?"
//        );
    }

//https://stackoverflow.com/questions/13545170/pdo-insert-array-using-key-as-column-name Bill Karwin je car!!!
    protected function doInsert(DomainObject $object)
    {
        $columns = array_keys( $object->getData());
        $column_list = join(',', $columns);
        $param_list = join(',', array_map(function($col) { return ":$col"; }, $columns));
        $sql = "INSERT INTO `{$this->table_name}` ($column_list) VALUES ($param_list)";

        $statement = $this->getConnection()->prepare($sql);
        if ($statement === false) {
            die(print_r($this->getConnection()->errorInfo(), true));
        }
        $status = $statement->execute($object->getData());
        if ($status === false) {
            die(print_r($statement->errorInfo(), true));
        }
        $id = intval($this->getConnection()->lastInsertId());
        $object->setId($id);

    }

    protected function targetClass(): string
    {
        return Mysql::class;
    }

    protected function selectStmt(): \PDOStatement
    {
        // TODO: Implement selectStmt() method.
    }

    public function selectAllStmt(IdentityObject $identityObject) :array
    {
        $select  = "select * from ". $this->table_name;
        $select .= $this->getSelection()->where($identityObject)? (" where " . $this->getSelection()->where($identityObject)): '';
        $select .= $identityObject->hasOrderBy()?(" ORDER BY " . join(',', $this->getSelection()->orderBy($identityObject))) : '';
        $select .= $identityObject->getLimit()? (" LIMIT " . $identityObject->getLimit()) : '';
//        var_dump($select);
        $connection = $this->getConnection();
        $statement = $connection->prepare($select);
//       / var_dump($select, $this->connection->prepare($select)->execute(), $this->connection);die;
        if ($statement === false) {
            die(print_r($this->getConnection()->errorInfo(), true));
        }

        $status = $statement->execute();
        if ($status === false) {
            die(print_r($statement->errorInfo(), true));
        }

        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);


        return $result;

    }

    public function getIdentity()
    {
        return new IdentityObjectMysql();
    }

    protected function getSelection()
    {
        return new SelectionFactoryMysql();
    }
}