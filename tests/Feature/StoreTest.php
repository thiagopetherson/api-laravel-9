<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Support\Carbon;

class StoreTest extends TestCase
{
    use RefreshDatabase; // Isso serve para limpar o banco após o teste

    /** @test */
    public function store_method_index()
    {
        $this->withoutExceptionHandling();

        $stores = Store::factory(2)->create();

        $response = $this->getJson('api/store');

        $response->assertStatus(200)->assertOk();

        $stores = Store::all();

        $response->assertJson([
            [
                "id" => $stores->first()->id,
                "name" => $stores->first()->name,
                "email" => $stores->first()->email,
                "created_at" => $stores->first()->created_at->format('Y-m-d H:i:s'),
                "updated_at" => $stores->first()->updated_at->format('Y-m-d H:i:s')
            ],
            [
                "id" => $stores->last()->id,
                "name" => $stores->last()->name,
                "email" => $stores->last()->email,
                "created_at" => $stores->last()->created_at->format('Y-m-d H:i:s'),
                "updated_at" => $stores->last()->updated_at->format('Y-m-d H:i:s')
            ]
        ]);
    }

    /** @test */
    public function store_method_show()
    {
        $this->withoutExceptionHandling();

        $store = Store::factory()->create();

        $response = $this->getJson("api/store/{$store->id}");

        $response->assertOk();

        $this->assertCount(1, Store::all());

        $response->assertJson(
            [
                "id" => $store->id,
                "name" => $store->name,
                "email" => $store->email,
                "created_at" => $store->created_at->format('Y-m-d H:i:s'),
                "updated_at" => $store->updated_at->format('Y-m-d H:i:s')
            ]
        );
    }

    /** @test */
    public function store_method_store()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson('api/store',[
            'name' => 'Loja Bonita Teste',
            'email' => 'lojabonitateste@email.com'
        ])->assertStatus(200);

        $store = Store::first();

        $this->assertCount(1, Store::all());

        $this->assertEquals('Loja Bonita Teste', $store->name);
        $this->assertEquals('lojabonitateste@email.com', $store->email);

        $response->assertJson(
            [
                "id" => $store->id,
                "name" => $store->name,
                "email" => $store->email
            ]
        );
    }

    /** @test */
    public function store_method_update()
    {
        $this->withoutExceptionHandling();

        $store = Store::factory()->create();

        $response = $this->putJson("api/store/{$store->id}",[
            'name' => 'Lojaa Bonitaa Testee',
            'email' => 'lojaabonitaatestee@email.com'
        ])->assertStatus(200);

        $this->assertCount(1, Store::all());

        $store = $store->fresh();

        $this->assertEquals('Lojaa Bonitaa Testee', $store->name);
        $this->assertEquals('lojaabonitaatestee@email.com', $store->email);

        $response->assertJson(
            [
                "id" => $store->id,
                "name" => $store->name,
                "email" => $store->email
            ]
        );
    }

    /** @test */
    public function store_method_destroy()
    {
        $this->withoutExceptionHandling();

        $store = Store::factory()->create();

        $response = $this->deleteJson("api/store/{$store->id}")->assertNoContent();

        $this->assertCount(0, Store::all());
    }

    /** @test */
    public function store_method_index_with_products()
    {
        $this->withoutExceptionHandling();

        Store::factory(2)->create();
        Product::factory(10)->create();

        $response = $this->getJson('api/store-index-with-products');

        $response->assertStatus(200)->assertOk();

        $stores = Store::with('products')->get();

        $response->assertJson([
            [
                "id" => $stores->first()->id,
                "name" => $stores->first()->name,
                "email" => $stores->first()->email,
                "created_at" => $stores->first()->created_at,
                "updated_at" => $stores->first()->updated_at,
                "products" => [
                    [
                        "id" => $stores->first()->products->first()->id,
                        "store_id" => $stores->first()->products->first()->store_id,
                        "name" => $stores->first()->products->first()->name,
                        "value" => $stores->first()->products->first()->value,
                        "active" => $stores->first()->products->first()->active,
                        "created_at" => $stores->first()->products->first()->created_at->format('Y-m-d H:i:s'),
                        "updated_at" => $stores->first()->products->first()->updated_at->format('Y-m-d H:i:s')
                    ]
                ]
            ]
        ]);
    }

    /** @test */
    public function store_method_test_index_with_products_without_product()
    {
        // Esse teste é para caso a store chamar os produtos mas não ter products associados
        // Nomeei esse teste com o prefixo "test" pq ele estava dando erro e sendo confundido com o método acima

        $this->withoutExceptionHandling();

        Store::factory(2)->create();

        $response = $this->getJson('api/store-index-with-products');

        $response->assertStatus(200)->assertOk();

        $stores = Store::with('products')->get();

        $response->assertJson(fn (AssertableJson $json) =>
        $json->has(2)
            ->first(fn ($json) =>
                $json->where('id', $stores->first()->id)
                    ->where('name', $stores->first()->name)
                    ->where('email', fn ($email) => str($email)->is($stores->first()->email))
                    ->where('created_at', $stores->first()->created_at->format('Y-m-d H:i:s'))
                    ->where('updated_at', $stores->first()->updated_at->format('Y-m-d H:i:s'))
                    ->where('products', [])
            )
        );
    }

}
