<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 21.9.17.
 * Time: 10.48
 */

namespace Bgw\core;


abstract class DomainObject
{
    private $id;

    private $data = array();


    public function __construct(int $id)
    {
        $this->id = $id;

        if ($id < 0) {
            $this->markNew();
        }
    }

    abstract public function getFinder(): Mapper;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function markNew()
    {
        ObjectWatcher::addNew($this);
    }

    public function markDeleted()
    {
        ObjectWatcher::addDelete($this);
    }

    public function markDirty()
    {
        ObjectWatcher::addDirty($this);
    }

    public function markClean()
    {
        ObjectWatcher::addClean($this);
    }

    //---------------------------------

    public function getData()
    {
        return $this->data;
    }


    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Magic __call method
     *
     * @param string $method
     * @param array $args
     */
    public function __call($method, $args)
    {
        $methodType = substr($method, 0, 3);
        $paramName = strtolower(substr($method, 3, 1)) . substr($method, 4);
        $paramSplit = preg_split('/(?<=\\w)(?=[A-Z])/', $paramName);

        $param = strtolower(join('_', $paramSplit));

        switch ($methodType) {
            case 'set':
                $arg = current($args);
                if (in_array($param, array("client_id", "id_client"))) {
                    $this->_client_id_key = $param;
                }
                $this->data[$param] = $arg;
                return $this;
                break;
            case 'get':
                if (isset($this->data[$param])) {
                    return $this->data[$param];
                } else {
                    return null;
                }
                break;
        }
    }

    /**
     * Magic __get method
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        } else {
            return null;
        }
    }

    /**
     * Magic __set method
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;

        return $this;
    }


}
