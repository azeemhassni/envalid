<?php namespace azi\Tests;

/**
 * Tests for azi\Validator
 * Class ValidatorTest
 *
 * @package azi
 */
class EnvalidTest extends TestCase
{
    public function testItAcceptsRules()
    {
        $this->validator->validate(['name' => 'azeem@example.com'], [
            'name' => 'required'
        ]);
        $this->assertEquals(['name' => 'required'], $this->validator->getRules());
    }

    public function testItAcceptsArguments()
    {
        $this->validator->validate(['name' => false], [
            'name' => 'required--message=Please type your name'
        ]);

        $errors = $this->validator->getErrors();

        $this->assertEquals('Please type your name', $errors->get('name')[ 0 ]);
    }

    public function testItSendsMultipleErrorMessagesAtTheSameTime()
    {
        $this->validator->validate(['email' => null], [
            'email' => 'required|email'
        ]);

        $errors = $this->validator->getErrors();

        $this->assertEquals('Email is required', $errors->get('email')->first());
        $this->assertEquals('Email must be a valid email address', $errors->get('email')->last());
    }

    public function testItValidatesRequiredFields()
    {
        $this->validator->validate(['name' => 'Azeem Hassni'], [
            'name' => 'required'
        ]);

        $this->assertTrue($this->validator->passed());
    }

    public function testItValidatesEmailFields()
    {
        $this->validator->validate(['email_address' => 'john@example.com'], [
            'email_address' => 'required|email'
        ]);

        $this->assertTrue($this->validator->passed());
    }




}
