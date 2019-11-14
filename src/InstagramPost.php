<?php

namespace Retinens\LaravelInstagram;

use Illuminate\Database\Eloquent\Model;

class InstagramPost extends Model
{
    protected $guarded = [];

    protected $casts = [
        'post' => 'array',
    ];

    /**
     * This returns the url of the image with standard resolution.
     * @return mixed
     */
    public function getStandardResolutionImageUrlAttribute()
    {
        return $this->post['images']['standard_resolution']['url'];
    }

    /**
     * This returns the thumbnail url, a smaller image.
     * @return mixed
     */
    public function getThumbnailImageUrlAttribute()
    {
        return $this->post['images']['thumbnail']['url'];
    }

    /**
     * This returns the caption, with line returns.
     * @return mixed
     */
    public function getCaptionTextAttribute()
    {
        return $this->post['caption']['text'];
    }

    /**
     * This returns the html formatted caption.
     * @return string
     */
    public function getHtmlCaptionTextAttribute()
    {
        return nl2br($this->post['caption']['text']);
    }

    /**
     * This returns the direct link to the post on instagram.
     * @return mixed
     */
    public function getLinkAttribute()
    {
        return $this->post['link'];
    }
}
