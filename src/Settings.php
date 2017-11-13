<?php

namespace Specter;

use Illuminate\Support\Collection;

final class Settings extends Collection
{
    /**
     * Get all settings under a single type.
     *
     * @param  string $type
     * @return self
     */
    public function type(string $type)
    {
        return $this->where('type', $type)->values();
    }

    /**
     * Group settings by type.
     * @TODO: keyby?
     *
     * @return array
     */
    public function namespace()
    {
        return $this->groupBy('type')->toArray();
    }

    /**
     * Get a single setting's value.
     *
     * @param  string $key
     * @return mixed
     */
    public function value(string $key)
    {
        return $this->get($key)['value'];
    }

    /**
     * Get key value array of settings
     *
     * @param  array  $keys
     * @return array
     */
    public function values(array $keys = [])
    {
        if (count($keys) == 0) {
            return $this->pluck('value', 'key')->toArray();
        }

        return $this->only($keys)->pluck('value', 'key')->toArray();
    }

    /**
     * Determine if a labs feature is enabled.
     *
     * @param  string $feature
     * @return bool
     */
    public function labs(string $feature) : bool
    {
        $labs = $this->value('labs');

        if (property_exists($labs, $feature)) {
            return $labs->{$feature};
        }

        return false;
    }
}
