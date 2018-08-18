<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Author;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuote;

class QuoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::paginate(5);
        return view('quotes.index')->with('quotes', $quotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('quotes.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuote $request)
    {
        $author = Author::firstOrCreate(['name' => $request->author]);
        
        $quote = new Quote;
        $quote->text = $request->text;
        $quote->author()->associate($author);
        $quote->user()->associate(\Auth::user());
        $quote->category()->associate($request->subcategory);
        $quote->save();
        $request->session()->flash('status', 'Task was successful!');
        return redirect()->route('quotes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit(Quote $quote)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('quotes.edit')->with('quote', $quote)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuote $request, Quote $quote)
    {
        $author = Author::firstOrCreate(['name' => $request->author]);
        
        $quote->text = $request->text;
        $quote->author()->associate($author);
        $quote->category()->associate($request->subcategory);
        $quote->update();

        return redirect()->route('quotes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();
        \Session::flash('status', 'Task was successful!');
        return redirect()->route('quotes.index');
    }

    /**
     * Like or unlike the specified quote
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function like(Quote $quote)
    {
        $quote->toggleLikeBy(\Auth::user()->id);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
