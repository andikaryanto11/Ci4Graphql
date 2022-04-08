<?php

namespace App\Graphql;

use AndikGraphql\Interfaces\IQuery;
use AndikGraphql\Query;
use App\Graphql\Resolvers\Test;

class QueryResolver extends Query implements IQuery
{
     public $queries = [];

    public function register()
    {
         $this->queries = [
              'getTest' => new Test(),
         ];
         return $this;
    }
}
