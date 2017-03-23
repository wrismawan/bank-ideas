<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request) {

        $data['ideas'] = Idea::all();

        return view('admin')->with($data);

    }


}
