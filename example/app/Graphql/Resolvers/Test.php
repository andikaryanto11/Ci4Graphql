<?php

namespace App\Graphql\Resolvers;

use AndikGraphql\LogicResolver;

class Test extends LogicResolver
{

    public function reveal($root, $args, $context)
    {
         return 'test';
    }
}
