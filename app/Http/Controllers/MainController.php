<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
