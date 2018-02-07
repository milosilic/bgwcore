<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 7.2.18.
 * Time: 15.50
 */

namespace Bgw\Core\DomainObject;


use Bgw\Core\Mapper;
use Bgw\Core\Registry;

class DomainObjectMongo
{
    public function getFinder(): Mapper
    {
        $reg = Registry::instance();

        return $reg->getMongoMapper();


    }


}