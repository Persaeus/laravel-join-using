<?php

namespace Nihilsen\LaravelJoinUsing;

use Illuminate\Database\Query\Builder;

trait CompilesJoinUsing
{
    public function compileWheres(Builder $query)
    {
        if (
            $query instanceof JoinUsingClause &&
            !is_null($query->using)
        ) {
            $columns = collect($query->using)
                ->map(fn ($column) => $this->wrap($column))
                ->implode(',');

            return 'using (' . $columns . ')';
        }

        return parent::compileWheres($query);
    }
}
