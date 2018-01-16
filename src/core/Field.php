<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 6.10.17.
 * Time: 10.04
 */

namespace Bgw\core;

class Field
{
    protected $name = null;
    protected $operator = null;
    protected $comps = [];
    protected $incomplete = false;

    // sets up the field name (age, for example)
    public function __construct(string  $name)
    {
        $this->name = $name;
    }

    // add the operator and the value for the test
    // (> 40, for example) and add to the $comps property
    public function add(string $operator, $value)
    {
        $this->comps[] = [
            'name' => $this->name,
            'operator' => $operator,
            'value' => $value
        ];
    }

    // comps is an array so that we can test one field in more than one way
    public function getComps(): array
    {
        return $this->comps;
    }

    // if $comps does not contain elements, then we have
    // comparison data and this field is not ready to be used in
    // a query
    public function isIncomplete(): bool
    {
        return empty($this->comps);
    }
}
