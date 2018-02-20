<?php

declare(strict_types=1);

namespace InFw\DB\Manager;

use InFw\DB\Connection\Connection;

class ConnectionManager
{
    /**
     * @var Connection[]
     */
    private $connections;

    /**
     * @var Connection[]
     */
    private $openConnections;

    public function __construct(array $connections)
    {
        $this->openConnections = [];

        array_walk($connections, function (Connection $connection): void {
            $this->connections[$connection->id()] = function () use ($connection) {
                $this->openConnections[$connection->id()] = $connection();
                return $this->openConnections[$connection->id()];
            };
        });
    }

    public function get(string $id): Connection
    {
        if (array_key_exists($id, $this->openConnections)) {
            $connection = $this->openConnections[$id];
        } else {
            $connection = $this->connections[$id];
        }

        return $connection();
    }

    public function close()
    {
        $this->connections = [];
        $this->openConnections = [];
    }

}
