<?php declare(strict_types=1);

use Kipkron\Collection\Tests\Customer;
use Kipkron\Collection\Tests\CustomerCollection;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    #[Test]
    public function itShouldCreateAnEmptyCollection(): void
    {
        $collection = new CustomerCollection();

        $this->assertEmpty($collection);
    }

    #[Test]
    public function itShouldAddAnItemToACollection(): void
    {
        $collection = new CustomerCollection();
        $customer = new Customer(1, "test@example.org");
        $collection->add($customer);

        $this->assertCount(1, $collection);
    }

    #[Test]
    public function itShouldIterateOverACollection(): void
    {
        $collection = new CustomerCollection();
        $customer = new Customer(1, "test@example.org");
        $collection->add($customer);
        $collection->add($customer);

        $count = 0;
        foreach ($collection as $customer) {
            $count++;
        }

        $this->assertEquals(2, $count);
    }
}
