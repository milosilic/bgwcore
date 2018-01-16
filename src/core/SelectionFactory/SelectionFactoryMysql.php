<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 6.10.17.
 * Time: 12.44
 */

namespace bgw\core\SelectionFactory;


use Bgw\core\IdentityObject;
use Bgw\core\SelectionFactory;

class SelectionFactoryMysql extends SelectionFactory
{

    public function newSelection(IdentityObject $obj): array
    {

    }

    public function where( IdentityObject $obj ) {

        if ( $obj->isVoid() ) {

            return '1';

        }

        $compstrings = array();

        foreach ( $obj->getComps() as $comp ) {
            if ( $comp['operator'] == 'IS NULL' || $comp['operator'] == 'IS NOT NULL'  ) {
                $compstrings[] = "{$comp['name']} {$comp['operator']}";
            } else if ($comp['operator'] != 'IN' && $comp['operator'] != 'NOT IN') {
                $compstrings[] = "{$comp['name']} {$comp['operator']} '{$comp['value']}'";
            } else {
                $compstrings[] = "{$comp['name']} {$comp['operator']} {$comp['value']}";
            }
        }

        $where = implode( " AND ", $compstrings );

        return $where;
    }

    public function orderBy( IdentityObject $obj = null ) {

        if ( is_null($obj) ) {

            return array();

        }

        $result = array();

        foreach ( $obj->getOrderBy() as $key => $value) {

            $result[] = $key . (strtolower($value) == 'desc' ? ' DESC' : ' ASC');

        }

        return $result;
    }

    public function limit( IdentityObject $obj = null ) {

        if ( is_null($obj) ) {

            return '';

        }

        $result = $obj->getLimit();

        return $result;
    }

    public function offset( IdentityObject $obj = null ) {
        if ( is_null($obj) ) {

            return 0;

        }

        return $obj->getOffset() ? $obj->getOffset() : 0;
    }

    public function group( IdentityObject $obj = null ) {

        if( is_null($obj) || $obj->isVoid() ) {

            return '';
        }

        return $obj->getGroup();
    }

}