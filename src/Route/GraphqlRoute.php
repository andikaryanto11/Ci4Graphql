<?php

namespace AndikGraphql\Route;

use CodeIgniter\Router\RouteCollection;

class GraphqlRoute
{
     /**
      * Code igniter will have "/graphql" route wihth any method
      * @param CodeIgniter\Router\RouteCollection $routw
      */
     static function route(RouteCollection $routes, string $controller)
     {
          $routes->match(["post", "put", "get", "delete"], '/graphql', $controller);
     }
}
