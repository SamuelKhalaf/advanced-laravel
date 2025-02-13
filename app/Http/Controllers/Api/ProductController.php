<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Requests\Product\CreateProductValidator;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController
{
    public $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return $this->productService->getProducts();
    }

    public function store(CreateProductValidator $createProductValidator)
    {
        // validation
        if (!empty($createProductValidator->getErrors())){
            return response()->json($createProductValidator->getErrors() , 422);
        }

        // create new product
        $data = $createProductValidator->all();
        $data['user_id'] = Auth::id();
        $data = $this->productService->createProduct($data);
        return $this->sendResponse($data);
    }

    public function update($id , CreateProductValidator $createProductValidator)
    {
        // validation
        if (!empty($createProductValidator->getErrors())){
            return response()->json($createProductValidator->getErrors() , 422);
        }

        // update product
        $data = $createProductValidator->all();
        $data['user_id'] = Auth::id();
        $data = $this->productService->updateProduct($id ,$data);
        return $this->sendResponse($data);
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return $this->sendResponse('deleted successfully');
    }
}
