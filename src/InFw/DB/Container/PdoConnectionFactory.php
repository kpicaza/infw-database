<?php

declare(strict_types=1);

namespace InFw\DB\Container;

use InFw\DB\Connection\PdoConnection;
use Psr\Container\ContainerInterface;

class PdoConnectionFactory
{
    const DEFAULT_CONN = 'default_connection';

    public function __invoke(ContainerInterface $container, $id = self::DEFAULT_CONN): PdoConnection
    {
        $config = $container->get('config')['database'];

        $connectionConfig = $this->getConnection($config, $id);

        $dsn = sprintf(
            'mysql:dbname=%s;host=%s;port=%s',
            $connectionConfig['dbname'],
            $connectionConfig['host'],
            $connectionConfig['port']
        );

        $conn = new PdoConnection(
            $dsn,
            $connectionConfig['user'],
            $connectionConfig['password'],
            $connectionConfig['options']
        );

        $conn();

        return $conn;
    }

    private function getConnection(array $config, string $id): array
    {
        if (self::DEFAULT_CONN === $id) {
            return $config['connection'][$config[self::DEFAULT_CONN]];
        }

        return $config['connection'][$id];
    }
}
