<?php

namespace App\Traits;

use App\Contracts\MustHaveSluggableAttribute;
use App\Exceptions\InvalidSluggableAttribute;
use Illuminate\Support\Str;

trait UseSlugAsRouteKey
{
    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @var string[]
     */
    protected static $modelMethods = [
        'creating',
        'updating'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        if (new self instanceof MustHaveSluggableAttribute) {
            self::createOrUpdateSlug();
        }
    }

    /**
     * @return void
     */
    protected static function createOrUpdateSlug(): void
    {
        $field = self::getSluggableAttribute();

        foreach (self::$modelMethods as $method) {
            static::$method(function ($model) use ($field) {
                $model->slug = Str::slug($model->$field, '-');
            });
        }
    }

    /**
     * @return string
     * @throws InvalidSluggableAttribute
     */
    public static function getSluggableAttribute(): string
    {
        $sluggable = self::SLUGGABLE_ATTRIBUTE;

        if (! isset($sluggable)) {
            throw new InvalidSluggableAttribute('You must specify a valid [SLUGGABLE_ATTRIBUTE] on implementing model.');
        }

        return self::SLUGGABLE_ATTRIBUTE;
    }
}
