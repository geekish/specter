<?php

namespace Specter\Models;

class Tag extends Model
{
    use Concerns\HasFeatureImage;
    use Concerns\HasSlug;
    use Concerns\HasVisibility;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'parent',
    ];

    /**
     * The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    protected $withCount = [
        // 'posts',
    ];

    /**
     * Parent of this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Tag::class)->withDefault();
    }

    /**
     * Posts that are assigned this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_tags', 'tag_id', 'post_id');
    }
}
