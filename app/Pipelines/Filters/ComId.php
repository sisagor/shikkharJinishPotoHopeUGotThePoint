<?php

namespace App\Pipelines\Filters;


class ComId extends Filter
{
    protected function applyFilter($builder)
    {
        if (is_admin_group()){
            return $builder->where($this->filterName(), request($this->filterName()));
        }
        return $builder->where($this->filterName(), com_id());
    }
}

