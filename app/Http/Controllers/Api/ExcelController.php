<?php

namespace App\Http\Controllers\Api;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Requests\Product\ImportProductValidator;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends BaseController
{
    public function export()
    {
        return Excel::download(new ProductExport(),'export1.xlsx');
    }

    public function import(ImportProductValidator $importProductValidator)
    {
        // validation
        if (!empty($importProductValidator->getErrors())){
            return response()->json($importProductValidator->getErrors() , 422);
        }

        Excel::import( new ProductImport(),$importProductValidator->request()->file('file')->store('files'));
        return $this->sendResponse('Saved successfully');
    }
}
