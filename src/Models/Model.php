<?php

namespace Specter\Models;

use Illuminate\Database\Eloquent;
use Illuminate\Support\Str;

class Model extends Eloquent\Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * READ ONLY OVERRIDE
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = [])
    {
        return false;
    }

    /**
     * READ ONLY OVERRIDE
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @param  array  $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        return false;
    }

    /**
     * READ ONLY OVERRIDE
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete()
    {
        return false;
    }
}
