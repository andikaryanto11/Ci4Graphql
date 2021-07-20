<?php

namespace AndikAryanto11\Route;

use CodeIgniter\Router\RouteCollection;

class GraphqlRoute
{
     /**
      * Code igniter will have "/graphql" route wihth any method
      * @param CodeIgniter\Router\RouteCollection $routw
      */
     static function route(RouteCollection $routes)
     {
          $routes->match(["post", "put", "get", "delete"], '/graphql', 'GraphQL::index');
     }
     public static function test(){

     }
}
