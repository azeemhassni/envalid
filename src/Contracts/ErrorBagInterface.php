<?php

namespace azi\Contracts;

use azi\ErrorMessages;

/**
 * Interface ErrorBagInterface
 *
 * @package azi\Contracts
 */
interface ErrorBagInterface
{
    /**
     * @param $key
     * @param $error
     * @return $this
     */
    public function addError($key, $error);

    /**
     * @return bool
     */
    public function hasErrors();

    /**
     * @return array
     */
    public function getErrors();

    /**
     * @param $key
     * @return bool
     */
    public function has($key);

    /**
     * @param $key
     * @return ErrorMessages
     */
    public function get($key);

    /**
     * @return mixed
     */
    public function isEmpty();

    /**
     * @return array
     */
    public function toArray();
}