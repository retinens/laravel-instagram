<?php

namespace Retinens\LaravelInstagram\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Retinens\LaravelInstagram\InstagramPost;
use Retinens\LaravelInstagram\LaravelInstagram;
use Vinkla\Instagram\Instagram;

class LaravelInstagramUpdateCacheTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_cache()
    {
        $response = new Response(200, [], json_encode([
            'data' => range(0, 19),
            'meta' => [],
        ]));
        $client = new Client();
        $client->addResponse($response);
        $instagram = new Instagram('jerryseinfield', $client);
        LaravelInstagram::updateCache($instagram);
        $this->assertCount(20, InstagramPost::all());
    }

    /** @test */
    public function it_clears_everything_before_adding()
    {
        for ($i = 0; $i < 2; $i++) {
            $response = new Response(200, [], json_encode([
                'data' => range(0, 19),
                'meta' => [],
            ]));
            $client = new Client();
            $client->addResponse($response);
            $instagram = new Instagram('jerryseinfield', $client);
            LaravelInstagram::updateCache($instagram);
        }

        $this->assertCount(20, InstagramPost::all());
    }
}
