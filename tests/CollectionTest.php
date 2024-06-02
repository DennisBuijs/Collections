<?php declare(strict_types=1);

use Kipkron\Collection\Collection;
use Kipkron\Collection\InvalidTypeException;
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

    #[Test]
    public function itShouldReturnAnItemByIndex(): void
    {
        $collection = new CustomerCollection();
        $customer = new Customer(1, "test@example.org");
        $customer2 = new Customer(2, "test2@example.org");
        $collection->add($customer);
        $collection->add($customer2);

        $customerByIndex = $collection->at(1);

        $this->assertEquals("test2@example.org", $customerByIndex->email);
    }

    #[Test]
    public function itShouldFilterItems(): void
    {
        $collection = new CustomerCollection();
        $customer = new Customer(1, "test@example.org");
        $customer2 = new Customer(2, "test2@example.org");
        $collection->add($customer);
        $collection->add($customer2);

        $customers = $collection->filter(fn($item) => $item->email === "test2@example.org");

        $this->assertCount(1, $customers);
        $this->assertEquals("test2@example.org", $customers->at(0)->email);
    }

    #[Test]
    public function itShouldTakeAnyTypeOfItem(): void
    {
        $collection = new Collection();
        $collection->add(1);
        $collection->add("one");

        $item = $collection->at(1);

        $this->assertEquals("one", $item);
    }

    #[Test]
    public function itShouldTakeOnlyItemsOfACertainType(): void
    {
        $collection = (new Collection())->of(Customer::class);

        $customer = new Customer(1, "test@example.org");
        $collection->add($customer);
        $this->assertCount(1, $collection);

        $this->expectException(InvalidTypeException::class);
        $collection->add(1);
        $this->assertCount(1, $collection);

        $collection->add($customer);
        $this->assertCount(2, $collection);
    }
}
