<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class ProductCreateViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_example()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_access_product_create_form()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->get('/products/create');

        $response->assertStatus(200);

        $response->assertViewIs('products.create');

        $response->assertSee('商品名');
        $response->assertSee('価格');
        $response->assertSee('登録する');

    }
}
