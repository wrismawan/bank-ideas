<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;

class UserController extends Controller
{
    public function editIdea()
    {
        return view('user_editidea');
    }

    public function storeIdea(Request $request) {
        if ($request->id == "") {
            $newIdea = new Idea();
        } else {
            $newIdea = Idea::find($request->id);
        }

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'owner' => 'required|email'
        ]);


        $newIdea->name = $request->name;
        $newIdea->description = $request->description;
        $newIdea->owner = $request->owner;
        //$newIdea->status = $request->status;
        $newIdea->save();
        return redirect()->route('idea.next');
    }

}
