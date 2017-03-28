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
                    $insert[] = [
                        'name' => $value->name,
                        'description' => $value->description,
                        'owner' => $value->owner
                    ];
                }
                if(!empty($insert)){
                    DB::table('ideas')->insert($insert);
                    dd('Import Successfully');
                }
            }
        } return back();
    }

    public function editIdea($id){
        $data['idea'] = Idea::find($id);
        return view('edit_idea')->with($data);
    }

//    public function updateIdea($id)
//    {
//        DB::table('ideas')->where('id',$id)->update(['name','$name'],['description','description']);
//    }

    public function updateIdea(Request $request) {
        $editIdea = Idea::find($request->id);
//        dd($request->all());
        $editIdea->name = $request->name;
        $editIdea->description = $request->description;
        $editIdea->save();
        return redirect()->route('admin.dashboard');
    }

    public function deleteIdea(Request $request)
    {
        $deleteIdea = Idea::find($request->id);
        $deleteIdea->delete();
        return redirect()->route('admin.dashboard');
    }
}
