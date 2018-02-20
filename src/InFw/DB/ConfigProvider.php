<?php

namespace InFw\DB;

use InFw\DB\Container\PdoFactory;
use PDO;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    PDO::class => PdoFactory::class,

                ]
            ],
            'database' => [
                'default_connection' => 'default',
                'connection' => [
                    'default' => [
                        'implementation' => 'pdo',
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
