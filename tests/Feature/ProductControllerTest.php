<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to verify that the index method returns all products.
     *
     * @return void
     */
    public function testIndexReturnsAllProducts(): void
    {
        // Arrange: Create mock products
        Product::factory()->create(['name' => 'Gaming Laptop']);
        Product::factory()->create(['name' => 'Mechanical Keyboard']);

        // Act: Perform a GET request to the index endpoint
        $response = $this->get(route('product.index'));

        // Assert: Verify the response status and view data
        $response->assertStatus(200);
        $response->assertViewHas('viewData.products', function (mixed $products): bool {
            return $products->count() === 2; // Validate that two products are returned
        });
    }

    /**
     * Test to verify that the show method returns a single product.
     *
     * @return void
     */
    public function testShowReturnsSingleProduct(): void
    {
        // Arrange: Create a mock product
        $product = Product::factory()->create(['name' => 'Gaming Mouse']);

        // Act: Perform a GET request to the show endpoint
        $response = $this->get(route('product.show', ['id' => $product->getId()]));

        // Assert: Verify the response status and view data
        $response->assertStatus(200);
        $response->assertViewHas('viewData.product', function (mixed $viewProduct) use ($product): bool {
            return $viewProduct->getId() === $product->getId(); // Validate that the correct product is returned
        });
    }
}
