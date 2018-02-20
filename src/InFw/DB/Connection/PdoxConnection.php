<?php

declare(strict_types=1);

namespace InFw\DB\Connection;

use Buki\Pdox;

class PdoxConnection extends Pdox implements Connection
{
    private $id = 'default_connection';
    private $config;

    public function __construct(array $config, bool $lazy = true)
    {
        $this->config = $config;
        if (!$lazy) {
            parent::__construct($this->config);
        }
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
        if (null === $this->pdo) {
            parent::__construct($this->config);
        }

        return $this;
    }
}
