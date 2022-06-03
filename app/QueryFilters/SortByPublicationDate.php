<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Http\Request;

class SortByPublicationDate
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('sort_by')
            && $request->get('sort_by') === 'publication_date'
        ) {
            return $next($request)->latest('publication_date');
        }

        return $next($request);
    }
}
