<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Official;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index');
    }
    public function about()
    {
        return view('home.about');
    }
    public function news()
    {
        return view('home.news');
    }
    public function official()
    {
        $official = Official::orderBy('id','DESC')->get();
        return view('home.official',[
            'official' => $official
        ]);
    }
    public function officialSearch()
    {
        $official = Official::orderBy('id','DESC')->get();
        return view('home.official-search',[
            'official' => $official
        ]);
    }
    public function officialDetail($slug)
    {
        $detail_official_view = Official::where('slug',$slug)->first();
        // dd($detail_official_view);
        if (!empty($detail_official_view)) {
            return view('home.official-detail',[
                'detail_official_view' => $detail_official_view
            ]);
        }else{
            return abort(404);
        }
    }
    public function tutorial()
    {
        return view('home.tutorial');
    }
    public function contact()
    {
        return view('home.contact');
    }
}
