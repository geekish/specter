<?php

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Collection;
use Spatie\PaginateRoute\PaginateRouteFacade as PaginateRoute;

if (!function_exists('markdown')) {
    function markdown($markdown) {
        return Markdown::convertToHtml($markdown);
    }
}

if (!function_exists('specter_path')) {
    function specter_path(string $append = null) {
        $path = dirname(__DIR__);

        return realpath($path . ($append ? DIRECTORY_SEPARATOR . $append : $append));
    }
}

/**
 * Paginate a collection, using per_page setting
 *
 * @param  Collection  $collection
 * @param  Request     $request
 * @return \Illuminate\Pagination\LengthAwarePaginator
 */
if (!function_exists('paginate')) {
    function paginate(Collection $collection) {
        $perPage = config('specter.per_page') ?? 5;
        $page = PaginateRoute::currentPage();
        $items = $collection->forPage($page, $perPage);

        return new Paginator($items, $collection->count(), $perPage, $page);
    }
}
