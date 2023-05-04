<?php

namespace Azi\Envalid\Tests;


use Azi\Envalid\Envalid;

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