<?php

namespace Specter\Models;

class Page extends Story
{
    /**
     * Boot Page model
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('page', 1);
        });
    }
}
