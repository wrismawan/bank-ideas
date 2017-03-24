<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function dashboard(Request $request) {

        $data['ideas'] = Idea::all();

        return view('admin')->with($data);

    }

    public function import()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key =>$value) {
                    $insert[] = ['name' => $value->name, 'description' => $value->description];
                }
                if(!empty($insert)){
                    DB::table('ideas')->insert($insert);
                    dd('Import Successfully');
                }
            }
        } return back();
    }


}
