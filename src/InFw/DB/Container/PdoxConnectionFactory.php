<?php

declare(strict_types=1);

namespace InFw\DB\Container;

use InFw\DB\Connection\Connection;
use InFw\DB\Connection\PdoxConnection;
use Psr\Container\ContainerInterface;

class PdoxConnectionFactory
{
    const DEFAULT_CONNECTION = 'default.connection';

    public function __invoke(ContainerInterface $container, string $id = self::DEFAULT_CONNECTION): Connection
    {
        $config = $container->get('config')['database'];

        $dbConfig = $this->formatConfigAsPdoxStyle($config['connection'][$id]);

        return new PdoxConnection($dbConfig);
    }

    protected function formatConfigAsPdoxStyle(array $config): array
    {
        if (array_key_exists('username', $config)) {
            return $config;
        }

        return [
            'host' => sprintf('%s:%s', $config['host'], $config['port']),
            'driver' => $config['driver'],
            'database' => $config['dbname'],
            'username' => $config['user'],
            'password' => $config['password'],
            'charset' => $config['charset'],
            'collation' => 'utf8_general_ci',
            // 'prefix'     => '',
            // 'cachedir'	=> __DIR__ . '/cache/sql/'
        ];
    }
}
