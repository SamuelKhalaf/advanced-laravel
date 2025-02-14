<?php
namespace wdd\slug\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
class SlugController extends Controller
{
    public function index()
    {
        $slug = Str::slug('hwll sdf sdfg');

        return view('wdd/slug::slug',compact('slug'));
    }
}
