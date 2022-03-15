<?php

namespace Tests\Feature;

use Database\Factories\SellerFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecordSellerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_seller_and_sale()
    {
        $sellerData = [
            "name" => "Renato Tests",
            "email" => "renatoteste@gmail.com",
        ];

        $seller = $this->json('POST', 'api/sellers', $sellerData, ['Accept' => 'application/json'])
            ->assertStatus(201);

        $saleData = [
            'amount' => 100.00,
            'seller_id' => $seller['id']
        ];
        $seller = $this->json('POST', 'api/sales', $saleData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'amount' => 100.00,
                'commission' => 8.50,
                'seller_id' => $seller['id'],
            ]);
    }
}
