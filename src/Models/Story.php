<?php

namespace Specter\Models;

use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;

class Story extends Model
{
    use Concerns\HasFeatureImage;
    use Concerns\HasSlug;
    use Concerns\HasVisibility;
    use Searchable;

    public $asYouType = true;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'content',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'published_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'mobiledoc',
        'html',
        // 'plaintext',
        'amp',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'featured' => 'boolean',
        'page' => 'boolean',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'author',
    ];

    /**
     * @var array
     */
    protected $searchables = [
        'title',
        'plaintext',
    ];

    /**
     * Get the user that this post belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * Get the tags that this post belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags', 'post_id', 'tag_id');
    }

    /**
     * Scope featured stories only
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    /**
     * Scope published stories only
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Get markdown content from mobiledoc cards
     *
     * @return string
     */
    public function getContentAttribute()
    {
        $mobiledoc = $this->getAttribute('mobiledoc');
        $json = json_decode($mobiledoc, true);
        $markdown = $json['cards'][0][1]['markdown'];

        return $markdown;
    }

    /**
     * Check if story has custom excerpt
     *
     * @return bool
     */
    public function hasCustomExcerpt() : bool
    {
        return !empty($this->getAttribute('custom_excerpt'));
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        if (!$this->isPublished() || $this->isInternal()) {
            return [];
        }

        $data = $this->toArray();
        $keys = Arr::prepend($this->searchables, 'id');
        return Arr::only($data, $keys);
    }
}
