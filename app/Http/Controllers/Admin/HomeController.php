<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Official;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
    	$number_oficial_join_month = Official::where('created_at','>',Carbon::now()->subHour(24))->count();
    	$total_official = Official::all()->count();
        return view('admin.index',[
        	'number_oficial_join_month' => $number_oficial_join_month,
        	'total_official' => $total_official
        ]);
    }

}
