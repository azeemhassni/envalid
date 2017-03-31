<?php
/**
 * Created by PhpStorm.
 * User: azi
 * Date: 3/27/17
 * Time: 11:04 PM
 */

namespace azi\Tests;


use azi\Validator;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Validator
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
