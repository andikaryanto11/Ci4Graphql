<?php

namespace AndikGraphql;

use AndikGraphql\Interfaces\ILogicResolver;

class LogicResolver implements ILogicResolver{

     public function __invoke($root, $args, $context)
     {
          return $this->reveal($root, $args, $context);
     }

     /**
      * @inheritdoc
      */
     public function reveal($root, $args, $context){

     }

     /**
      * Tell Resolver to return invokable class
      */
     public static function execute()
     {
          return new static;
     }
}