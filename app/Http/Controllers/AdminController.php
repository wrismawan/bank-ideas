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

        return view('update_idea')->with($data);
    }

    //*Next, fungsi store dan update Idea buat admin bisa di merge

    public function store(Request $request) {
        $newIdea->name = $request->name;
        $newIdea->description = $request->description;
        $newIdea->owner = $request->owner;
        //$newIdea->status = $request->status;
        $newIdea->save();
        return back();
    }

    public function updateIdea(Request $request) {
        $editIdea = Idea::find($request->id);
        $editIdea->name = $request->name;
        $editIdea->description = $request->description;
        $editIdea->owner = $request->owner;
        //$editIdea->status = $request->status;
        $editIdea->save();
        return redirect()->route('admin.dashboard');
    }

    public function deleteIdea(Request $request)
    {
        $deleteIdea = Idea::find($request->id);
        $deleteIdea->delete();
        return redirect()->route('admin.dashboard');
    }

    public function infoBoard()
    {
        $data['reg_total'] = DB::table('users')->where('fb_id','<>','NULL')->count();
        $data['reg_today'] = DB::table('users')->where('fb_id','<>','NULL')->whereRaw('created_at <= date_sub(curdate(), INTERVAL 0 day)')->count();
        $data['reg_yesterday'] = DB::table('users')->where('fb_id','<>','NULL')->whereRaw('created_at <= date_sub(curdate(), INTERVAL 1 day)')->count();

        $data['unique_total'] = DB::table('users')->count();
        $data['unique_today'] = DB::table('users')->whereRaw('created_at <= date_sub(curdate(), INTERVAL 0 day)')->count();
        $data['unique_yesterday'] = DB::table('users')->whereRaw('created_at <= date_sub(curdate(), INTERVAL 1 day)')->count();

        $data['last_reg_users'] = DB::table('users')->where('fb_id','<>','NULL')->orderBy('created_at','desc')->limit(5)->get();


        dd(DB::table('users')
            ->join('user_actions','user_actions.user_id', '=', 'user_actions.user_id')
            ->select(DB::raw('select u.name, COUNT(ua.id) as ctr FROM user_actions ua, users u WHERE u.id = ua.user_id GROUP BY user_id HAVING ctr >= 5'))
            ->get()) ;

        return view('information_board')->with($data);
    }
}
