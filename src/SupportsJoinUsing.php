<?php

namespace Nihilsen\LaravelJoinUsing;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Grammars\Grammar;

trait SupportsJoinUsing
{
    protected function getDefaultQueryGrammar()
    {
        /** @var \Illuminate\Database\Connection $this */
        return $this->withTablePrefix($this->getQueryGrammarForJoinUsing());
    }

    abstract public function getQueryGrammarForJoinUsing(): Grammar;

    public function query()
    {
        return new class (
            $this,
            $this->getQueryGrammar(),
            $this->getPostProcessor()
        ) extends Builder {
            protected function newJoinClause(Builder $parentQuery, $type, $table)
            {
                return new JoinUsingClause($parentQuery, $type, $table);
            }
        };
    }
}
