<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ContentLog
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $description
 * @property string $content_type
 * @property string|null $url
 * @property array|null $keywords
 * @property array|null $categories
 * @property int $views
 * @property int $engagement
 * @property \Illuminate\Support\Carbon $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog whereCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog whereContentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog whereEngagement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentLog whereViews($value)
 * @method static \Database\Factories\ContentLogFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ContentLog extends Model
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
        'content_type',
        'url',
        'keywords',
        'categories',
        'views',
        'engagement',
        'published_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'date',
        'keywords' => 'array',
        'categories' => 'array',
        'views' => 'integer',
        'engagement' => 'integer',
    ];

    /**
     * Get the user that owns the content log.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to filter by content type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByType($query, $type)
    {
        return $query->where('content_type', $type);
    }

    /**
     * Scope a query to order by performance.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByPerformance($query)
    {
        return $query->orderByDesc('views')->orderByDesc('engagement');
    }
}