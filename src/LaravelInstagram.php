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
     * This returns posts from the database, limiting to an optional given amount
     */
    public static function getPosts($amount = null)
    {
        if ($amount === null) {
            return InstagramPost::all();
        } elseif ($amount > 0) {
            return InstagramPost::take($amount)->get();
        } else {
            throw new LaravelInstagramException('Amount should be positive');
        }
    }

    /**
     * This refreshes the instagram cache by calling the API and storing the data in the database.
     * @param  null  $instagram
     */
    public static function updateCache($instagram = null): void
    {
        // @codeCoverageIgnoreStart
        if ($instagram === null) {
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
