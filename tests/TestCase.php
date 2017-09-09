<?php

namespace azi\Tests;


use azi\Envalid;

/**
 * Class TestCase
 *
 * @package azi\Tests
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Envalid
     */
    protected $validator;

    public function setUp()
    {
        $this->validator = new Envalid();
    }

    public function tearDown()
    {
        $this->validator = null;
    }


}