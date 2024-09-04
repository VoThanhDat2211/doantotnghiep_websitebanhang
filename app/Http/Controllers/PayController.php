<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller
{
    public function create(Request $request)
    {
        $input = $request->all();
        dd($input);
    }
}
