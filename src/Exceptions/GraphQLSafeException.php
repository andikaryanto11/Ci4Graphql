<?php

namespace AndikGraphql\Exceptions;

use Exception;
use GraphQL\Error\ClientAware;

class GraphQLSafeException extends Exception implements ClientAware{
    
    /**
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }

    /**
     * @inheritdoc
     * @return bool
     */
    public function isClientSafe(): bool
    {
        return true;
    }

    /**
     * 
     */
    public function getCategory()
    {
        return "Default Error";
    }


}