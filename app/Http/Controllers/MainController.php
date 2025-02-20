<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class MainController extends Controller
{
    public function charts()
    {
        $chart_options  = [
            'chart_title' => 'Users by day',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
        ];

        $chart1 = new LaravelChart($chart_options);

        return view('charts', compact('chart1') );
    }

    public function reduceStock(Request $request)
    {
        DB::transaction(function () use ($request) {
            // Lock the product row
            $product = Product::where('id', $request->id)->lockForUpdate()->first();

            if ($product->stock > 0) {
                sleep(5);

                // Reduce stock
                $product->stock -= 1;
                $product->save();

                echo "Stock updated successfully. New stock: " . $product->stock;
            } else {
                echo "Out of stock!";
            }
        });
    }
}
