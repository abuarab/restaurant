<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\User;

class OrderTest extends TestCase
{

    /**
     * test order
     */
    public function testOrder()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/user');

        $this->json('POST', '/api/order', [
            'product_id' => '1',
            'quantity' => '2'
            ])->seeJson([
                'status' => 'success',
            ]);
    }
}
