<?php

namespace azi\Tests;


use azi\Envalid;

/**
 * Class TestCase
 *
 * @package azi\Tests
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Envalid
     */
    protected $validator;

    public function setUp(): void
    {
        $this->validator = new Envalid();
    }

    public function tearDown(): void
    {
        $this->validator = null;
    }


}