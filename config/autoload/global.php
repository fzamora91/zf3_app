<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.

 'driver_options'=>[
              PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAME \'UTF8\''
         ],
 */

return [
    // ...
    'db'=>[
         'driver'=>"pdo_pgsql",
         /*'database'=>"db_zend",
         /*'hostname'=>"localhost",*/
         'dsn'=>'pgsql:dbname=db_zend;host=localhost;port=5432',
         /*'driver_options'=>[
              PDO::PGSQL_ATTR_INIT_COMMAND => 'SET NAME \'UTF8\''
         ],*/      
    ]
];
