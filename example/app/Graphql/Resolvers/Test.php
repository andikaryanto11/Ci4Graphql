<?php

namespace App\Graphql\Resolvers;

use AndikGraphql\LogicResolver;
use GraphQL\Type\Definition\ResolveInfo;

class Test extends LogicResolver
{

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
         return 'test';
    }
}
