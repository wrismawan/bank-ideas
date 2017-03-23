<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Request $request) {
        return view('show_idea');
    }
}
