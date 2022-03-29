<?php

use AndikGraphql\Route\GraphqlRoute;
$routes = Services::routes();

// here you can use Graphql route. it should be baseUrl/graphql
GraphqlRoute::route($routes, 'GraphQL::index');