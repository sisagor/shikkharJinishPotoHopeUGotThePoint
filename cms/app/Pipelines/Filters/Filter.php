<?php

namespace App\Pipelines\Filters;

use Illuminate\Support\Str;

abstract class Filter
{

    public function handle($request, \Closure $next){

        if (! request()->has($this->filterName())){
            $next($request);
        }

        $builder = $next($request);

        return $this->applyFilter($builder);
    }


    protected abstract function applyFilter($builder);

    protected function filterName(): string
    {
        return Str::snake(class_basename($this));
    }

}
