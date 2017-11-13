<?php

namespace Specter\Models;

class User extends Model
{
    use Concerns\HasVisibility;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ghost_auth_access_token',
        'ghost_auth_id',
        'password',
    ];

    /**
     * Get the posts that belong to this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id', 'id');
    }
}
