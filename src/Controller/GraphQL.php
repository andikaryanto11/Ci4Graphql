<?php

use CodeIgniter\Controller;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Executor\Executor;

class GraphQL extends Controller
{

     public function index()
     {
          $this->setResolvers(include '../Graphql/resolvers.php');
          $schema = \GraphQL\Utils\BuildSchema::build(file_get_contents('../Graphql/schema.graphqls'));

          $input = $this->request->getJSON();
          $query = $input->query;

          $variables = isset($input->variables) ? $input->variables : null;

          $context = [
               'db'     => $this->db
          ];

          $result = \GraphQL\GraphQL::executeQuery($schema, $query, null, $context, $variables);

          // $response->getBody()->write(json_encode($result));

          // $sqlQueryLogger = $this->db->getConfiguration()->getSQLLogger();
          // $this->logger->info(json_encode($sqlQueryLogger->queries));

          return $this->response->setStatusCode(200)
				->setJSON($result);
     }

     private function setResolvers($resolvers)
     {
          Executor::setDefaultFieldResolver(function ($source, $args, $context, ResolveInfo $info) use ($resolvers) {
               $fieldName = $info->fieldName;

               if (is_null($fieldName)) {
                    throw new \Exception('Could not get $fieldName from ResolveInfo');
               }

               if (is_null($info->parentType)) {
                    throw new \Exception('Could not get $parentType from ResolveInfo');
               }

               $parentTypeName = $info->parentType->name;

               if (isset($resolvers[$parentTypeName])) {
                    $resolver = $resolvers[$parentTypeName];

                    if (is_array($resolver)) {
                         if (array_key_exists($fieldName, $resolver)) {
                              $value = $resolver[$fieldName];

                              return is_callable($value) ? $value($source, $args, $context, $info) : $value;
                         }
                    }

                    if (is_object($resolver)) {
                         if (isset($resolver->{$fieldName})) {
                              $value = $resolver->{$fieldName};

                              return is_callable($value) ? $value($source, $args, $context, $info) : $value;
                         }
                    }
               }

               return Executor::defaultFieldResolver($source, $args, $context, $info);
          });
     }
}
