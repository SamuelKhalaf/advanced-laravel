<?php

namespace App\Requests\Product;

use App\Requests\BaseRequestFormApi;

class ImportProductValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'file' => 'required|mimes:csv,xlsx|max:10240',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
