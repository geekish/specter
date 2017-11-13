<?php

namespace Specter\Models\Concerns;

use Illuminate\Database\Eloquent;
use Illuminate\Support\Str;

trait HasVisibility
{
    /**
     * Check if model has visibility: public
     *
     * @return bool
     */
    public function isPublic() : bool
    {
        return ($this->visibility === 'public');
    }

    /**
     * Check if model has visibility: internal
     *
     * @return bool
     */
    public function isInternal() : bool
    {
        return ($this->visibility === 'internal');
    }

    /**
     * Scope model query by visibility
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  string $visibility
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisibility($query, string $visibility)
    {
        return $query->where('visibility', $visibility);
    }

    /**
     * Scope model query by visibility: public
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublic($query)
    {
        return $query->where('visibility', 'public');
    }

    /**
     * Scope model query by visibility: internal
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInternal($query)
    {
        return $query->where('visibility', 'internal');
    }
}
