<?php

namespace Retinens\LaravelInstagram;

use Illuminate\Database\Eloquent\Model;

class InstagramPost extends Model
{
    protected $guarded = [];

    protected $casts = [
        'post' => 'array',
    ];

    public function getStandardResolutionImageUrlAttribute()
    {
        return $this->post['images']['standard_resolution']['url'];
    }

    public function getThumbnailImageUrlAttribute()
    {
        return $this->post['images']['thumbnail']['url'];
    }

    public function getCaptionTextAttribute()
    {
        return nl2br($this->post['caption']['text']);
    }

    public function getLinkAttribute()
    {
        return $this->post['link'];
    }
}
