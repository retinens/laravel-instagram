<?php

namespace Retinens\LaravelInstagram;

use Illuminate\Database\Eloquent\Collection;
use Vinkla\Instagram\Instagram;

class LaravelInstagram
{
    /**
     * @param  null  $amount
     * @return Collection|InstagramPost[]
     * @throws LaravelInstagramException
     *
     * This returns posts
     */
    public static function getPosts($amount = null)
    {
        if ($amount == null) {
            return InstagramPost::all();
        } elseif ($amount > 0) {
            return InstagramPost::take($amount)->get();
        } else {
            throw new LaravelInstagramException('Amount should be positive');
        }
    }

    public static function updateCache($instagram = null) :void
    {
        // @codeCoverageIgnoreStart
        if ($instagram == null) {
            $instagram = new Instagram(env('INSTAGRAM_KEY'));
        }
        // @codeCoverageIgnoreStart

        $instagrams = $instagram->media();
        InstagramPost::truncate();
        foreach ($instagrams as $instagram_post) {
            $store = new InstagramPost();
            $store->post = $instagram_post;
            $store->save();
        }
    }
}
