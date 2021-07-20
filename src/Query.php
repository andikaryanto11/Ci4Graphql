<?php

namespace AndikGraphql;

class Query {

     /**
      * @var array 
      */
     public $queries;

     /**
      * get array queries data
      * @return array
      */
     public function execute(){
          return $this->queries;
     }
}