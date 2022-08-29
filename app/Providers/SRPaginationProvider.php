<?php

namespace App\Providers;

use App\Pagination\CustomPaginator;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class SRPaginationProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Builder::macro("sr_paginate", function ($perPage = null, $columns = ['*'], $pageName = 'page', $page = null) {
            $page = $page ?: Paginator::resolveCurrentPage($pageName);

            $perPage = $perPage ?: $this->model->getPerPage();

            $results = ($total = $this->toBase()->getCountForPagination())
                ? $this->forPage($page, $perPage)->get($columns)
                : $this->model->newCollection();

            return $this->sr_paginator($results, $total, $perPage, $page, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]);

        });

        Builder::macro("sr_paginator", function ($items, $total, $perPage, $currentPage, $options) {
            return Container::getInstance()->makeWith(CustomPaginator::class, compact(
                'items', 'total', 'perPage', 'currentPage', 'options'
            ));
        });
    }
}
