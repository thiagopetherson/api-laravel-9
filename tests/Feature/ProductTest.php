<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Product;
use App\Models\Store;

class ProductTest extends TestCase
{
    use RefreshDatabase; // Isso serve para limpar o banco após o teste

    /** @test */
    public function product_method_index()
    {
        $this->withoutExceptionHandling();

        $store = Store::factory()->create();

        $products = Product::factory(2)->create();

        $response = $this->getJson('api/product');

        $response->assertOk();

        $products = Product::all();

        $response->assertJson([
            [
                "id" => $products->first()->id,
                "store_id" => $products->first()->store_id,
                "name" => $products->first()->name,
                "value" => $products->first()->value,
                "active" => $products->first()->active,
                "created_at" => $products->first()->created_at,
                "updated_at" => $products->first()->updated_at
            ],
            [
                "id" => $products->last()->id,
                "store_id" => $products->last()->store_id,
                "name" => $products->last()->name,
                "value" => $products->last()->value,
                "active" => $products->last()->active,
                "created_at" => $products->last()->created_at,
                "updated_at" => $products->last()->updated_at
            ]
        ]);
    }

    /** @test */
    public function product_method_show()
    {
        $this->withoutExceptionHandling();

        $store = Store::factory()->create();

        $product = Product::factory()->create();

        $response = $this->getJson("api/product/{$product->id}");

        $response->assertOk();

        $this->assertCount(1, Product::all());

        $response->assertJson(
            [
                "id" => $product->id,
                "store_id" => $product->store_id,
                "name" => $product->name,
                "value" => $product->value,
                "active" => $product->active,
                "created_at" => $product->created_at,
                "updated_at" => $product->updated_at
            ]
        );
    }

    /** @test */
    public function product_method_store()
    {
        $this->withoutExceptionHandling();

        $store = Store::factory()->create();

        $response = $this->postJson('api/product',[
            'store_id' => $store->id,
            'name' => 'Produto Inserido Teste',
            'value' => 5537,
            'active' => 1
        ])->assertStatus(200);

        $product = Product::first();

        $this->assertCount(1, Product::all());

        $this->assertEquals($store->id, $product->store_id);
        $this->assertEquals('Produto Inserido Teste', $product->name);
        $this->assertEquals('R$ 5.537,00', $product->value);
        $this->assertEquals(1, $product->active);

        $response->assertJson(
            [
                "id" => $product->id,
                "store_id" => $product->store_id,
                "name" => $product->name,
                "value" => $product->value,
                "active" => $product->active,
                "created_at" => $product->created_at,
                "updated_at" => $product->updated_at
            ]
        );
    }

    /** @test */
    public function product_method_update()
    {
        $this->withoutExceptionHandling();

        $store = Store::factory()->create();

        $product = Product::factory()->create();

        $response = $this->putJson("api/product/{$product->id}",[
            "store_id" => $store->id,
            "name" => 'Produto Atualizado Teste',
            "value" => 8435,
            "active" => 0
        ])->assertStatus(200);

        $this->assertCount(1, Product::all());

        $product = $product->fresh();

        $this->assertEquals($store->id, $product->store_id);
        $this->assertEquals('Produto Atualizado Teste', $product->name);
        $this->assertEquals('R$ 8.435,00', $product->value);
        $this->assertEquals(0, $product->active);

        $response->assertJson(
            [
                "id" => $product->id,
                "store_id" => $product->store_id,
                "name" => $product->name,
                "value" => $product->value,
                "active" => $product->active,
                "created_at" => $product->created_at,
                "updated_at" => $product->updated_at
            ]
        );
    }

    /** @test */
    public function product_method_destroy()
    {
        $this->withoutExceptionHandling();

        $store = Store::factory()->create();

        $product = Product::factory()->create();

        $response = $this->deleteJson("api/product/{$product->id}")->assertNoContent();

        $this->assertEmpty(Product::all());
    }

    /** @test */
    public function product_method_index_with_store()
    {
        $this->withoutExceptionHandling();

        Store::factory(5)->create();
        Product::factory(50)->create();

        $response = $this->getJson('api/product-index-with-store');

        $response->assertStatus(200)->assertOk();

        $products = Product::with('store')->get();

        $response->assertJson([
            [
                "id" => $products->first()->id,
                "store_id" => $products->first()->store_id,
                "value" => $products->first()->value,
                "active" => $products->first()->active,
                "created_at" => $products->first()->created_at,
                "updated_at" => $products->first()->updated_at,
                "store" => [
                    "id" => $products->first()->store->id,
                    "name" => $products->first()->store->name,
                    "email" => $products->first()->store->email,
                    "created_at" => $products->first()->store->created_at,
                    "updated_at" => $products->first()->store->updated_at
                ]
            ]
        ]);
    }

    /** @test */
    public function product_method_show_with_store()
    {
        $this->withoutExceptionHandling();

        Store::factory(5)->create();
        Product::factory(100)->create();
        $product = Product::all()->random();

        $response = $this->getJson("api/product-show-with-store/{$product->id}");

        $response->assertStatus(200)->assertOk();

        $product = Product::with('store')->where('id',$product->id)->first();

        $response->assertJson([
            "id" => $product->id,
            "store_id" => $product->store_id,
            "name" => $product->name,
            "value" => $product->value,
            "active" => $product->active,
            "created_at" => $product->created_at,
            "updated_at" => $product->updated_at,
            "store" => [
                "id" => $product->store->id,
                "name" => $product->store->name,
                "email" => $product->store->email,
                "created_at" => $product->store->created_at,
                "updated_at" => $product->store->updated_at
            ]
        ]);
    }
}
