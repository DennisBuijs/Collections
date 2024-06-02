<?php declare(strict_types=1);

namespace Kipkron\Collection;

class InvalidTypeException extends \InvalidArgumentException
{
    public function __construct(string $expected, string $actual)
    {
        parent::__construct("Item not accepted by collection. Expected: " . $expected . ". Actual: " . $actual);
    }
}
