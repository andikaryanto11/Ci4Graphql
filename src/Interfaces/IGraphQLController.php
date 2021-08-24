<?php

namespace AndikGraphql\Interfaces;

interface IGraphQLController {

     /**
      * Logic to return your data
      * @return array
      */
     public function getContext();
}