<?php declare(strict_types=1);

namespace Kipkron\Collection\Tests;

readonly class Customer
{
    public function __construct(public int $id, public string $email)
    {
    }
}
