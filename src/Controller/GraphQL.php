<?php

namespace AndikGraphql\Controller;

use AndikGraphql\Interfaces\IGraphQLController;
use AndikGraphql\Resolver;
use CodeIgniter\Controller;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Executor\Executor;


class GraphQL extends Controller implements IGraphQLController
{
     protected $vendorDir;
     protected $schemas;

     public function __construct()
     {
          $reflection = new \ReflectionClass(\Composer\Autoload\ClassLoader::class);
          $this->vendorDir = dirname(dirname($reflection->getFileName()));
     }

     /**
      * @inheritdoc
      */
     public function getContext()
     {
     }

     public function index()
     {
          $this->setResolvers(Resolver::resolve());
          $this->setSchemas();
          $this->setAllAppSchemas();
          $builtSchemas = \GraphQL\Utils\BuildSchema::build($this->schemas);

          $input = $this->request->getJSON();
          $query = $input->query;

          $variables = isset($input->variables) ? $input->variables : null;

          $result = \GraphQL\GraphQL::executeQuery($builtSchemas, $query, null, $this->getContext(), (array)$variables);

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

     private function setSchemas()
     {
          $this->schemas = file_get_contents($this->vendorDir . '/andikaryanto11/ci4graphql/src/schema.graphqls');
          $this->schemas .= "\n" . file_get_contents(APPPATH . '/Graphql/schema.graphqls');
     }

     private function setAllAppSchemas()
     {
          $result = array();
          $dir = APPPATH . "/Graphql/Schemas";
          $cdir = scandir($dir);
          foreach ($cdir as $key => $value) {
               if (!in_array($value, array(".", ".."))) {
                    if (!is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                         $result[$value] = $value;
                         $this->schemas .= "\n" . file_get_contents(APPPATH . '/Graphql/Schemas/' . $value);
                    }
               }
          }
     }
}
