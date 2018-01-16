<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 30.9.17.
 * Time: 20.06
 */

namespace Bgw\core;


use Bgw\core\Mapper\Mysql;

abstract class PersistenceFactory
{

    abstract public function getMapper(): Mapper;
    abstract public function getDomainObjectFactory(): DomainObjectFactory;
    abstract public function getCollection(array $raw): Collection;

    public static function getFactory($targetclass): PersistenceFactory
    {
        switch ($targetclass) {
            case Mysql::class:
                return new PersistenceFactoryMysql();
                break;
            default:
                throw new AppException("Unknown class {$targetclass}");
                break;
        }
    }
}
