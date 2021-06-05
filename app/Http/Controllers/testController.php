<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    //
    public function test()
    {
        notify()->success('Laravel Notify is awesome!');


        return view('test.test');
    }
}
