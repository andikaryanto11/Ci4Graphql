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

          $queries = $query->register()->getQueries();
          $newQueries = [];
          foreach ($queries as $key => $q) {
               /**
                * @var LogicResolver $q
                */
               $newQueries[$key] = $q;
          }

          $mutations = $mutation->register()->getMutations();
          $newMutations = [];
          foreach ($mutations as $key => $m) {
               /**
                * @var LogicResolver $m
                */
               $newMutations[$key] = $m;
          }

          return [
               'Query' => $newQueries,
               'Mutation' => $newMutations
          ];
     }
}
