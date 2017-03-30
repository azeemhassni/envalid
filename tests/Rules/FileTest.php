<?php


namespace azi\Tests\Rules;


use azi\Tests\TestCase;

/**
 * Class FileTest
 *
 * @package azi\Tests\Rules
 */
class FileTest extends TestCase
{

    public function testItValidatesFiles()
    {
        $this->validator->validate([
            'profile_picture' => [
                'type'     => 'image/png',
                'name'     => 'image.png',
                'tmp_name' => dirname(__DIR__) . '/data/image.png',
                'size'     => filesize(dirname(__DIR__) . '/data/image.png')
            ]
        ], [
            'profile_picture' => 'file:image'
        ]);

        $this->assertTrue($this->validator->passed());
    }

    public function testItValidatesVideoFiles()
    {
        $this->validator->validate([
            'profile_picture' => [
                'type'     => 'video/mp4',
                'name'     => 'video.mp4',
                'tmp_name' => dirname(__DIR__) . '/data/video.mp4',
                'size'     => filesize(dirname(__DIR__) . '/data/video.mp4')
            ]
        ], [
            'profile_picture' => 'file:video'
        ]);

        $this->assertTrue($this->validator->passed());

    }
}