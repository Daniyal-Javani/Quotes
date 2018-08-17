<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryIds = \Auth::user()->categories()->pluck('categories.id');
        $quotes = Quote::whereIn('category_id', $categoryIds)->orderBy('created_at', 'desc')->get();
        return view('home')->with('quotes', $quotes);;
    }
}
