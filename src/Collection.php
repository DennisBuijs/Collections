<?php declare(strict_types=1);

namespace Kipkron\Collection;

use ArrayIterator;
use Countable;
use Traversable;

/** @template T */
abstract class Collection implements \IteratorAggregate, Countable
{
    /** @var T[] $items */
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    /** @param T $item */
    public function add($item): void
    {
        $this->items[] = $item;
    }

    /** @return T */
    public function at(int $index)
    {
        return $this->items[$index];
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
