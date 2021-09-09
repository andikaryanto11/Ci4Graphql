<?php

namespace AndikGraphql\Interfaces;

interface ILogicResolver {

     /**
      * Logic to return your data
      */
     public function reveal($root, $args, $context);

}