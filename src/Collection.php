<?php declare(strict_types=1);

namespace Kipkron\Collection;

use ArrayIterator;
use Countable;
use Traversable;

abstract class Collection implements \IteratorAggregate, Countable
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add($item): void
    {
        $this->items[] = $item;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }
}
