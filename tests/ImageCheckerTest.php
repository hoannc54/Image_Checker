<?php

use PHPUnit\Framework\TestCase;

class ImageCheckerTest extends TestCase
{
    public function testSampleFunction()
    {
        $path          = __DIR__ . '/gif1.gif';
        $image_checker = new \Joan\ImageChecker\ImageChecker($path);
        $this->assertTrue($image_checker->isGif());
    }

    public function testDetectFromUrl()
    {
        $url           = 'https://metrouk2.files.wordpress.com/2018/03/giphy9.gif';
        $image_checker = new \Joan\ImageChecker\ImageChecker($url);
        $r             = $image_checker->detect();
        $this->assertTrue($image_checker->isGif());
    }

    public function testPngFormat()
    {
        $url           = 'https://upload.wikimedia.org/wikipedia/commons/4/47/PNG_transparency_demonstration_1.png';
        $image_checker = new \Joan\ImageChecker\ImageChecker($url);
        $this->assertTrue($image_checker->isPng());
    }
}