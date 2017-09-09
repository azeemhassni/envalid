<?php

namespace azi;

use ArrayAccess;
use azi\Contracts\ErrorBagInterface;

/**
 * Class ErrorBag
 *
 * @package azi
 */
class ErrorBag implements ArrayAccess, ErrorBagInterface, \JsonSerializable
{
    /**
     * @var ErrorMessages[]
     */
    protected $errors = [];

    /**
     * Whether a offset exists
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->errors[ $offset ]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->getError($offset);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getError($key)
    {
        return $this->errors[ $key ];
    }

    /**
     * Offset to set
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->addError($offset, $value);
    }

    /**
     * @param $key
     * @param $message
     * @return ErrorBag
     */
    public function addError($key, $message)
    {
        if (!isset($this->errors[ $key ])) {
            $this->errors[ $key ] = new ErrorMessages($key);
        }

        $this->errors[ $key ]->add($message);
        return $this;
    }

    /**
     * Offset to unset
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->errors[ $offset ]);
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return !empty($this->errors);
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

        return $this->errors[ $key ];
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->errors[ $key ]);
    }

    /**
     * @return mixed
     */
    public function isEmpty()
    {
        return empty($this->errors);
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return array|\stdClass data to be json serialized
     */
    function jsonSerialize()
    {
        return $this->getErrors();
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->getErrors());
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array_map(function (ErrorMessages $error) {
            return $error->toArray();
        }, $this->getErrors());
    }
}