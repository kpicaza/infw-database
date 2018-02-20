<?php

declare(strict_types=1);

namespace InFw\DB\Connection;

use PDO;

class PdoConnection extends PDO implements Connection
{
    private $id = 'default_connection';
    private $dsn;
    private $username;
    private $passwd;
    private $options;

    public function __construct($dsn, $username, $passwd, $options)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->passwd = $passwd;
        $this->options = $options;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function __invoke(): self
    {
        parent::__construct($this->dsn, $this->username, $this->passwd, $this->options);

        return $this;
    }
}
