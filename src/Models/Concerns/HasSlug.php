<?php

namespace Specter\Models\Concerns;

trait HasSlug
{
    /**
     * Scope model query by slug
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSlug($query, string $slug)
    {
        return $query->where('slug', $slug);
    }
}
