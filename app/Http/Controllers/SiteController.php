<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function switchLanguage(Request $request)
    {
        session()->put('lang', $request->input('lang'));
        return back();
    }

}
