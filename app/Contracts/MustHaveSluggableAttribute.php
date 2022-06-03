<?php

namespace App\Contracts;

interface MustHaveSluggableAttribute
{
    /**
     * @return string
     */
    public static function getSluggableAttribute(): string;
}
