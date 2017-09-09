<?php

namespace azi;

/**
 * Class ErrorMessages
 *
 * @package azi
 */
class ErrorMessages implements \ArrayAccess, \JsonSerializable
{
    /**
     * @var array
     */
    protected $messages;

    /**
     * @var string
     */
    protected $field;

    /**
     * ErrorMessages constructor.
     *
     * @param $field
     */
    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * Add a message
     *
     * @param $message
     */
    public function add($message)
    {
        $this->messages[] = $message;
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->messages);
    }

    /**
     * @return int
     */
    public function count()
    {
        return sizeof($this->messages);
    }

    /**
     * Whether a offset exists
     *
     * @param mixed $offset An offset to check for.
     * @return boolean true on success or false on failure. The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @param $index
     * @return bool
     */
    public function has($index)
    {
        return !empty($this->messages[ $index ]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset The offset to retrieve.
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param $index
     * @return mixed
     */
    public function get($index)
    {
        return $this->messages[ $index ];
    }

    /**
     * Offset to set
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->messages[ $offset ] = $value;
    }

    /**
     * Offset to unset
     *
     * @param mixed $offset
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->messages);
    }

    /**
     * Returns the first message as string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->first();
    }

    /**
     * @return string
     */
    public function first()
    {
        return reset($this->messages);
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return array|\stdClass data to be json serialized
     */
    function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->messages;
    }
}