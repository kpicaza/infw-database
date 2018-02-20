<?php

declare(strict_types=1);

namespace InFw\DB\Container;

use PDO;
use Psr\Container\ContainerInterface;

class PdoFactory
{
    const DEFAULT_CONN = 'default_connection';

    public function __invoke(ContainerInterface $container, $id = self::DEFAULT_CONN): PDO
    {
        $config = $container->get('config')['database'];

        $connectionConfig = $this->getConnection($config, $id);

        $dsn = sprintf(
            'mysql:dbname=%s;host=%s;port=%s',
            $connectionConfig['dbname'],
            $connectionConfig['host'],
            $connectionConfig['port']
        );

        return new PDO(
            $dsn,
            $connectionConfig['user'],
            $connectionConfig['password'],
            $connectionConfig['options']
        );
    }

    private function getConnection(array $config, string $id): array
    {
        if (self::DEFAULT_CONN === $id) {
            return $config['connection'][$config[self::DEFAULT_CONN]];
        }

        return $config['connection'][$id];
    }
}