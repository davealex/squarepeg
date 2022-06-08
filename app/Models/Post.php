<?php

namespace App\Models;

use App\Contracts\MustHaveSluggableAttribute;
use App\QueryFilters\SortByPublicationDate;
use App\Traits\UseSlugAsRouteKey;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Str;
use Mtownsend\ReadTime\ReadTime;

class Post extends Model implements MustHaveSluggableAttribute
{
    use HasFactory, UseSlugAsRouteKey;

    /**
     * model attribute to generate slug from
     */
    const SLUGGABLE_ATTRIBUTE = 'title';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'publication_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication_date' => 'datetime',
    ];

    /**
     * eager load defined relationships
     * @var string[]
     */
    protected $with = ['user'];

    /**
     * @var string[]
     */
    protected $appends = [
        'preview',
        'read_time'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope post query to only include popular users.
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopePublishedAt(Builder $query): Builder
    {
        return app(Pipeline::class)
            ->send($query)
            ->through([
                SortByPublicationDate::class
            ])
        ->thenReturn();
    }

    /**
     * @return bool
     */
    public static function shouldBeOrderedByPublicationDate(): bool
    {
        $request = request();

        return $request->has('sort_by')
            && $request->query('sort_by') === 'publication_date';
    }

    /**
     * @return Closure
     */
    public static function orderByPublicationDate(): Closure
    {
        return function (Builder $query) {
            $query->latest('publication_date');
        };
    }

    /**
     * @param Builder|HasMany $query
     * @return mixed
     */
    public static function filteredPostsQuery(Builder|HasMany $query): mixed
    {
        return $query->when(
            Post::shouldBeOrderedByPublicationDate(),
            Post::orderByPublicationDate()
        );
    }

    /**
     * get `preview` attribute
     * @return Attribute
     */
    public function preview(): Attribute
    {
        return new Attribute(
            get: fn () => Str::limit($this->attributes['description'], 150, ' [... read more to continue]'),
        );
    }

    /**
     * get post `read_time` attribute
     * @return Attribute
     */
    public function readTime(): Attribute
    {
        return new Attribute(
            get: fn () => (new ReadTime($this->attributes['description']))->get()
        );
    }

    /**
     * @param mixed $query
     * @param int $perPage
     * @return Closure
     */
    public static function getPaginatedPosts(mixed $query, int $perPage): Closure
    {
        return function () use ($query, $perPage) {
            return $query->simplePaginate($perPage)
                ->withQueryString();
        };
    }
}
