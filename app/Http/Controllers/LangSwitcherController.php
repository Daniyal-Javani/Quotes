<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LangSwitcherController extends Controller
{
    public function LangSwitcher($lang) {
       Session::put('locale',$lang);
       // dd(session('locale'));
       // dd(\App::getLocale());
       return redirect()->back();
    }
}
