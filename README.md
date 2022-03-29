# Codeigniter 4 GraphQl
This package is created to create graphql in ci4 

# Install
  
    composer require andikaryanto11/ci4graphql

# Usage
  1. Create Controller Class then Extends to this **AndikGraphql\Controller\GraphQL**
  2. in ci4 route file add this line **AndikGraphql\Route\GraphqlRoute:routes($routes, 'YOUR_CONTROLLER::function')**
  3. create directory under app called 'Graphql' (all your graphql work will be inside here).
  4. Resolver class must extends **AndikGraphql\LogicResolver** then should have function with name **public function reveal({root}, {args}, {context})** 
  5. in QueryResolver / MutationResolver class, you must register your mutation / query like  

            public function register()
            {
                $this->queries = [
                    'getTest' => new Test(),
                ];
                return $this;
            }

  6. take a look at the example directory, the example directory structure looks like code igniter 4 to make it easy to understand

