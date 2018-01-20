<?php
declare(strict_types = 1);

namespace Bgw\Core\IdentityObject;
use Bgw\Core\IdentityObject;

/**
 * Created by PhpStorm.
 * User: ila
 * Date: 6.10.17.
 * Time: 08.12
 */

class IdentityObjectMongo extends IdentityObject
{
    // add an equality operator to the current field
    // ie 'age' becomes age=40
    // returns a reference to the current object (via operator())
    public function eq( $value ) {

        return $this->_operator( "=", $value );

    }

    public function gt( $value ) {

        return $this->_operator( '$gt', $value );

    }

    public function ge( $value ) {

        return $this->_operator( '$gte', $value );

    }

    public function lt( $value ) {

        return $this->_operator( '$lt', $value );

    }

    public function le( $value ) {

        return $this->_operator( '$lte', $value );

    }

    public function in( $value ) {

        return $this->_operator( '$in', $value );

    }

    public function nin( $value ) {

        return $this->_operator( '$nin', $value );

    }

    public function ne( $value ) {

        return $this->_operator( '$ne', $value );

    }

    public function either( $value = array() )
    {
        return $this->_operator( '$or', $value );
    }

}