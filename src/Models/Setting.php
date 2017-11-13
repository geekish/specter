<?php

namespace Specter\Models;

class Setting extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Scope setting by key
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKey($query, string $key)
    {
        return $query->where('key', $key)->first();
    }

    /**
     * Scope setting by type
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope setting by type(s)
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $types
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTypes($query, array $types = [])
    {
        return $query->whereIn('type', $types);
    }

    /**
     * Cast/convert setting values to appropriate type
     *
     * @return mixed
     */
    public function getValueAttribute($value)
    {
        $key = $this->getAttribute('key');
        $jsonKeys = ['labs', 'navigation', 'unsplash', 'slack', 'active_apps', 'installed_apps'];

        if (in_array($key, $jsonKeys)) {
            return json_decode($value);
        }

        return $value;
    }
}
