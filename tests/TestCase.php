<?php

namespace Retinens\LaravelInstagram\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;
use Retinens\LaravelInstagram\LaravelInstagramServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
        $this->setUpDatabase($this->app);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelInstagramServiceProvider::class,
        ];
    }

    /**
     * @param Application $app
     */
    protected function setUpDatabase($app)
    {
        Schema::dropAllTables();

        include_once __DIR__.'/../database/migrations/2019_11_04_105714_create_instagram_posts_table.php';

        (new \CreateInstagramPostsTable())->up();
    }
}
