<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/api');
        $response->assertStatus(200);
    }

    public function test_that_applucation_returns_empty_or_content_instead_of_error(): void
    {
        $response = $this->get('/api/customers?name=ma&cpf=122455788-12');
        $response->assertStatus(200);
    }
}