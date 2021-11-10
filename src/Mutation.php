<?php

namespace AndikGraphql;

class Mutation {

     /**
      * @var array 
      */
     public $mutations;

     /**
      * get array mutations data
      * @return array
      */
     public function getMutations(){
          return $this->mutations;
     }
}