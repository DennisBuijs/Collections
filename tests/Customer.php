<?php declare(strict_types=1);

namespace Kipkron\Collection\Tests;

class Customer
{
    public function __construct(private readonly int $id, private readonly string $email)
    {
    }
}
