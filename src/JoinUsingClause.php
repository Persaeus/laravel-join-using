<?php

namespace Nihilsen\LaravelJoinUsing;

use Illuminate\Database\Query\JoinClause;

class JoinUsingClause extends JoinClause
{
    /**
     * The columns to use in the USING subclause.
     *
     * @var string[]|null
     */
    public ?array $using = null;

    /**
     * Set the columns for the USING subclause.
     */
    public function using(string ...$columns)
    {
        $this->using = $columns;

        return $this;
    }
}
