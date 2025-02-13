<?php

namespace App\Requests\Product;

use App\Requests\BaseRequestFormApi;

class CreateProductValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:50' ,
            'description' => 'nullable|max:1000',
            'size' => 'required|min:30|max:100|numeric',
            'color' => 'required|in:red,green,blue',
            'price' => 'required|min:1|max:10000|numeric',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
