<?php

namespace App\Pipelines\Filters;


class BranchId extends Filter
{
    protected function applyFilter($builder)
    {
        if (is_admin_group() || is_company_group()){
            return $builder->where($this->filterName(), request($this->filterName()));
        }
        return $builder->where($this->filterName(), branch_id());
    }
}

