<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Customer;

class CustomerTest extends TestCase
{
    /**
     * Testing that the customer object is created
     */
    public function teste_that_customer_object_is_created()
    {
        $customer = new Customer([
            'name' => 'Maria da Silva',
            'cpf' => '326455122-08',
            'birthdate' => '1988/02/05',
            'phone_number' => '1195487-1122'
        ]);
        
        $this->assertTrue($customer->name === "Maria da Silva");
        $this->assertTrue($customer->cpf === "326455122-08");
    }

    /**
     * Testing that Customers table is already filled with some customers on start
     */
    public function test_that_db_is_filled_with_customers()
    {
        $customers = Customer::all();
        $this->assertTrue($customers->count() >= 5);
    }

    public function test_customers_collection_is_iterable()
    {
        $customers = Customer::all();
        $this->assertIsIterable($customers);
    }
}