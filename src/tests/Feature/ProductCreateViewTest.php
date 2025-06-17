<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Season;
use Illuminate\Http\UploadedFile;


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
        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        $response = $this->get(route('products.create'));

        $response->assertStatus(200);
        $response->assertViewIs('products.create');
        $response->assertSee('商品名');
        $response->assertSee('価格');
        $response->assertSee('登録する');
    }

    public function test_product_create_validation_error()
    {
        // ログイン用にテストユーザをDBに作成
        $user = User::factory()->create();
        // テストユーザでログイン済みにする
        $this->actingAs($user);
        // 商品登録画面を表示するためのgetリクエストを送信
        $response = $this->get(route('products.create'));
        // エラーが起きていないことを確認（200:正常に表示）
        $response->assertStatus(200);

        // 名前以外は入力しないデータを用意
        $product = [
            'name' => 'バナナ',
        ];
        // DBに商品登録するためのpostリクエストを送信
        $response = $this->post(route('products.store'), $product);
        // バリデーションエラーでリダイレクトされることを確認（302:リダイレクト）
        $response->assertStatus(302);
        // リダイレクト先が商品登録画面のパスであることを確認
        $response->assertRedirect(route('products.create'));
        // バリデーションエラーの情報が格納されていることを確認
        $response->assertSessionHasErrors([
            // 'name' => '商品名を入力してください',
            'price' => '値段を入力してください',
            'image' => '商品画像を登録してください',
            'description' => '商品説明を入力してください',
            'seasons' => '季節を選択してください',
        ]);
    }

    public function test_product_can_be_created()
    {
        /** @var \App\Models\User $user */
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

        $this->assertCount(1, Storage::disk('public')->files('images'));
    }
}
