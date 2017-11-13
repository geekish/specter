<?php

namespace Specter\Models;

class Post extends Story
{
    /**
     * Boot Post model
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('page', 0);
        });
    }
}
