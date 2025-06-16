<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Season;
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

        $response = $this->get(route('products.create'));

        $response->assertStatus(200);
        $response->assertViewIs('products.create');
        $response->assertSee('商品名');
        $response->assertSee('価格');
        $response->assertSee('登録する');

    }

    public function test_product_create_validation_error()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->from(route('products.create'))->post(route('products.store'), []);

        $response->assertSessionHasErrors([
            'name',
            'price',
            'image',
            'description',
            'seasons',
        ]);

        $response->assertSeeInOrder([
            '商品名を入力してください',
            '値段を入力してください',
            '商品画像を登録してください',
            '商品説明を入力してください',
            '季節を選択してください',
        ]);

    }

    public function test_product_can_be_created()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $season = Season::factory()->create();

        $image = UploadedFile::fake()->image('product.png');

        $product = [
            'name' => 'テスト商品',
            'price' => 500,
            'image' => $image,
            'description' => 'これはテストの商品です',
            'seasons' => [$season->id],
        ];

        $response = $this->post(route('products.store'), $product);

        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'テスト商品',
            'price' => 500,
            'description' => 'これはテストの商品です',
        ]);

        Storage::disk('public')->assertExists('images/' . $image->hashName());
    }
}
