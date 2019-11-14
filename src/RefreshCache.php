<?php

namespace Retinens\LaravelInstagram;

use Illuminate\Console\Command;

/**
 * @codeCoverageIgnore
 */
class RefreshCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-instagram:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refreshes the instagram post cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        LaravelInstagram::updateCache();
    }
}
