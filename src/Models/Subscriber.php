<?php

namespace Specter\Models;

class Subscriber extends Model
{
    /**
     * Get the post that this subscriber belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class)->withDefault();
    }
}
