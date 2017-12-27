<?php

namespace InFw\DB;

use PDO;
use Psr\Container\ContainerInterface;

class MySQLConnectionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['database'];

        $defaultConnection = $config['connection'][$config['default_connection']];

        $dsn = sprintf(
            'mysql:dbname=%s;host=%s;port=%s',
            $defaultConnection['dbname'],
            $defaultConnection['host'],
            $defaultConnection['port']
        );

        return new PDO(
            $dsn,
            $defaultConnection['user'],
            $defaultConnection['password'],
            $defaultConnection['options']
        );
    }
}
