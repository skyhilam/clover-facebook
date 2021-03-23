<?php

namespace clover\Facebook\Tests;

use clover\Facebook\Facades\Facebook;
use clover\Facebook\ServiceProvider;
use Orchestra\Testbench\TestCase;

class FacebookTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'facebook' => Facebook::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
