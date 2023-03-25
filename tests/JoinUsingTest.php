<?php

use Illuminate\Support\Facades\DB;
use Nihilsen\LaravelJoinUsing\JoinUsingClause;

it('can construct queries with JOIN USING syntax', function () {
    $query = DB::table('left_table')->rightJoin(
        'right_table',
        fn (JoinUsingClause $join) => $join->using('shared_column')
    );

    expect($query->toSql())->toBe('select * from "left_table" right join "right_table" using ("shared_column")');
});
