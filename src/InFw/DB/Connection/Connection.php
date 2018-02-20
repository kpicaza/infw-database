<?php

declare(strict_types=1);

namespace InFw\DB\Connection;

interface Connection
{
    public function id(): string;

    public function __invoke();
}
