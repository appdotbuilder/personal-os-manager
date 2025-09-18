<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ContentIdea
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $description
 * @property string $status
 * @property string $content_type
 * @property \Illuminate\Support\Carbon|null $scheduled_at
 * @property array|null $keywords
 * @property array|null $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea whereContentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea whereScheduledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentIdea whereUserId($value)
 * @method static \Database\Factories\ContentIdeaFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ContentIdea extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'content_type',
        'scheduled_at',
        'keywords',
        'tags',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'scheduled_at' => 'datetime',
        'keywords' => 'array',
        'tags' => 'array',
    ];

    /**
     * Get the user that owns the content idea.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include content ideas with a specific status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include scheduled content ideas.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeScheduled($query)
    {
        return $query->whereNotNull('scheduled_at');
    }
}