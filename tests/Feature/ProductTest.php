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
                "active" => $products->first()->active
            ],
            [
                "id" => $products->last()->id,
                "store_id" => $products->last()->store_id,
                "name" => $products->last()->name,
                "value" => $products->last()->value,
                "active" => $products->last()->active
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
                "active" => $product->active
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
                "active" => $product->active
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
                "active" => $product->active
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
}
