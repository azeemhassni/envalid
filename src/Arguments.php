<?php

namespace azi;

/**
 * Class Arguments
 *
 * @package azi
 * @method getVariables()
 * @method getArguments()
 */
class Arguments implements \ArrayAccess
{
    /**
     * @var array
     */
    protected $args;

    /**
     * Arguments constructor.
     *
     * @param array $args
     */
    public function __construct(array $args)
    {
        $this->args = $args;
    }

    /**
     * @param $name
     * @return mixed
     */
    function __get($name)
    {
        return $this->get($name);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if (!$this->has($key)) {
            return null;
        }

        return $this->args[ $key ];
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->args[ $key ]);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    function __call($name, $arguments)
    {
        if (substr($name, 0, 3) == 'get') {
            $prop = strtolower(substr($name, 3));
            return $this->get($prop);
        }

        return null;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * @param $key
     * @param $value
     * @return Arguments
     */
    public function set($key, $value)
    {
        $this->args[ $key ] = $value;

        return $this;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * @param $key
     * @return Arguments
     */
    public function remove($key)
    {
        unset($this->args[ $key ]);

        return $this;
    }

    /**
     * Get validator instance in rule classes
     *
     * @return Envalid
     */
    public function getValidator()
    {
        return $this->get('validator');
    }

}