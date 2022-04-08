<?php

namespace AndikGraphql\Interfaces;

use GraphQL\Type\Definition\ResolveInfo;

interface ILogicResolver {

     /**
      * Logic to return your data
      */
     public function resolve($root, $args, $context, ResolveInfo $info);
}
