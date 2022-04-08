<?php

namespace App\Graphql;

use AndikGraphql\Interfaces\IMutation;
use AndikGraphql\Mutation;

class MutationResolver extends Mutation implements IMutation
{
     public $mutations = [];

     /**
      * @inheritdoc
      */
    public function register()
    {
         $this->mutations = [
             'someMutation' => new YourMutationClass(),
         ];
         return $this;
    }
}
