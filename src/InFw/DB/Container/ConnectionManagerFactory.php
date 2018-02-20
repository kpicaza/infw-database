<?php

declare(strict_types=1);

namespace InFw\DB\Container;

use InFw\DB\Connection\Connection;
use InFw\DB\Manager\ConnectionManager;
use Psr\Container\ContainerInterface;

class ConnectionManagerFactory
{
    const AVAILABLE_IMPLEMENTATIONS = [
        'pdo' => PdoConnectionFactory::class,
        'pdox' => PdoxConnectionFactory::class,
    ];

    public function __invoke(ContainerInterface $container): ConnectionManager
    {
        $config = $container->get('config')['database'];

        $connections = array_map(function ($key) use ($container, $config) {
            $implementation = self::AVAILABLE_IMPLEMENTATIONS[$config['connection'][$key]['implementation']];
            $connFactory = new $implementation();

            /** @var Connection $conn */
            $conn = $connFactory($container, $key);
            if (method_exists($conn, 'setId')) {
                $conn->setId($key);
            }

            return $conn;
        }, array_keys($config['connection']));

        return new ConnectionManager($connections);
    }
}
