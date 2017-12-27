<?php

namespace InFw\DB;

use PDO;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    PDO::class => MySQLConnectionFactory::class,
                ]
            ],
            'database' => [
                'default_connection' => 'default',
                'connection' => [
                    'default' => [
                        'driver' => 'mysql',
                        'host' => '127.0.0.1',
                        'port' => '3306',
                        'user' => 'infw',
                        'password' => '',
                        'dbname' => 'infw',
                        'charset' => 'utf8',
                        'options' => [
                            1002 => "SET NAMES 'UTF8'"
                        ],
                    ],
                ],
            ],
        ];
    }
}
