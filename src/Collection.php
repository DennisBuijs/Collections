<?php declare(strict_types=1);

namespace Kipkron\Collection;

use ArrayIterator;
use Countable;
use Traversable;

/** @template T */
class Collection implements \IteratorAggregate, Countable
{
    /** @var T[] $items */
    private array $items;

    private string $type;

    public function __construct()
    {
        $this->items = [];
    }

    public function of(string $type): Collection
    {
        $this->type = $type;

        return $this;
    }

    /** @param T $item */
    public function add($item): void
    {
        if (isset($this->type) && !$item instanceof $this->type) {
            throw new InvalidTypeException($this->type, gettype($item));
        }

        $this->items[] = $item;
    }

    /** @return T */
    public function at(int $index)
    {
        return $this->items[$index];
    }

    public function filter(callable $fn): static
    {
        $collection = new static();

        $items = array_filter($this->items, $fn);
        foreach ($items as $item) {
            $collection->add($item);
        }

        return $collection;
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
