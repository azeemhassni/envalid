<?php

declare(strict_types=1);

namespace Azi\Envalid;

use ArrayAccess;
use Azi\Envalid\Contracts\ErrorBagInterface;
use ReturnTypeWillChange;

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
     * @param $key
     * @return mixed
     */
    public function getError($key)
    {
        return $this->errors[ $key ];
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
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->errors);
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

    /**
     * Whether a offset exists
     *
     * @param mixed $offset
     * @return bool
     */
    #[ReturnTypeWillChange] public function offsetExists($offset)
    {
        return isset($this->errors[ $offset ]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset
     * @return mixed
     */
    #[ReturnTypeWillChange] public function offsetGet($offset)
    {
        return $this->getError($offset);
    }

    /**
     * Offset to set
     *
     * @param mixed $offset
     * @param mixed $value
     */
    #[ReturnTypeWillChange] public function offsetSet($offset, $value)
    {
        $this->addError($offset, $value);
    }

    /**
     * Offset to unset
     *
     * @param mixed $offset
     */
    #[ReturnTypeWillChange] public function offsetUnset($offset)
    {
        unset($this->errors[ $offset ]);
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return mixed data to be json serialized
     */
    #[ReturnTypeWillChange] function jsonSerialize()
    {
        return $this->getErrors();
    }
}