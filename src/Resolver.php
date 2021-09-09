<?php

namespace AndikGraphql;

use App\Graphql\MutationResolver;
use App\Graphql\QueryResolver;

class Resolver
{

     /**
      * Resolve All Queries and Mutation Graphql
      */
     public static function resolve()
     {
          $query = new QueryResolver();
          $mutation = new MutationResolver();
          
          return [
               'Query' => $query->register()->execute(),
               'Mutation' => $mutation->register()->execute()
          ];
     }
}
