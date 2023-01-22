<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Store;

class StoreTest extends TestCase
{
    use RefreshDatabase; // Isso serve para limpar o banco após o teste

    /** @test */
    public function store_method_index()
    {
        $this->withoutExceptionHandling();

        $stores = Store::factory(2)->create();

        $response = $this->getJson('api/store');

        $response->assertOk();

        $stores = Store::all();

        $response->assertJson([
            [
                "id" => $stores->first()->id,
                "name" => $stores->first()->name,
                "email" => $stores->first()->email
            ],
            [
                "id" => $stores->last()->id,
                "name" => $stores->last()->name,
                "email" => $stores->last()->email
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
                "email" => $store->email
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

        $this->assertEquals($store->name, 'Loja Bonita Teste');
        $this->assertEquals($store->email, 'lojabonitateste@email.com');

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

        $this->assertEquals($store->name, 'Lojaa Bonitaa Testee');
        $this->assertEquals($store->email, 'lojaabonitaatestee@email.com');

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
}
