<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to verify that the index method returns all products.
     */
    public function testIndexReturnsAllProducts(): void
    {

        Product::factory()->create(['name' => 'Gaming Laptop']);
        Product::factory()->create(['name' => 'Mechanical Keyboard']);

        $response = $this->get(route('product.index'));

        $response->assertStatus(200);
        $response->assertViewHas('viewData.products', function (mixed $products): bool {
            return $products->count() === 2;
        });
    }

    /**
     * Test to verify that the show method returns a single product.
     */
    public function testShowReturnsSingleProduct(): void
    {

        $product = Product::factory()->create(['name' => 'Gaming Mouse']);

        $response = $this->get(route('product.show', ['id' => $product->getId()]));

        $response->assertStatus(200);
        $response->assertViewHas('viewData.product', function (mixed $viewProduct) use ($product): bool {
            return $viewProduct->getId() === $product->getId();
        });
    }
}
