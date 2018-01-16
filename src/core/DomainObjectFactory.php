<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 30.9.17.
 * Time: 20.19
 */

namespace Bgw\core;


abstract class DomainObjectFactory
{
    abstract public function createObject(array $row): DomainObject;

    /* /listing 13.31 */
    protected function getFromMap($class, $id)
    {
        return ObjectWatcher::exists($class, $id);
    }

    protected function addToMap(DomainObject $obj): DomainObject
    {
        return ObjectWatcher::add($obj);
    }
    /* listing 13.31 */
}
/* /listing 13.31 */
