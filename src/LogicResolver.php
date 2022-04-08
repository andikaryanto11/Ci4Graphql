<?php

namespace AndikGraphql;

use AndikGraphql\Interfaces\ILogicResolver;
use GraphQL\Type\Definition\ResolveInfo;

class LogicResolver implements ILogicResolver {

     public function __invoke($root, $args, $context, ResolveInfo $info)
     {
          return $this->resolve($root, $args, $context, $info);
     }

     /**
      * @inheritdoc
      */
     public function resolve($root, $args, $context, ResolveInfo $info){

     }

}
