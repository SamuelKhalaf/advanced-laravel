<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class ProductTest extends TestCase
{
    protected $productService;
    protected $product;

    public function setUp(): void
    {
        parent::setUp();

        $this->productService = $this->app->make('App\Services\ProductService');
        $this->product=[
            'name' => 'Admin name',
            'email' => 'admin@admin.com',
            'password' => 'admin admin'
        ];
    }

    public function test_product_create_database()
    {
       $created_product = $this->productService->createProduct($this->product);

//       $this->assertDatabaseHas()
    }
}
