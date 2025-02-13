<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
//    use RefreshDatabase;

    protected $productService;
    protected $product;

    public function setUp(): void
    {
        parent::setUp();

        $this->productService = $this->app->make('App\Services\ProductService');
        $this->product=[
            'title' => 'computer',
            'description' => 'this is a computer',
            'user_id' => 2,
            'size' => 50,
            'color' => 'red'
        ];
    }

    public function test_product_create_database()
    {
        $this->productService->createProduct($this->product);

        $this->assertDatabaseHas('products' , ['title' => 'computer']);
        $this->assertDatabaseHas('product_details' , ['size' => 50,]);
    }

    public function test_product_delete_database()
    {
        $this->productService->deleteProduct(6);

        $this->assertDatabaseMissing('products' , ['title' => 'computer']);
        $this->assertDatabaseMissing('product_details' , ['size' => 50,]);
    }
}
