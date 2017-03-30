<?php

namespace App\Http\Controllers;

use App\Idea;
use App\User;
use App\UserAction;
use App\Uuids;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Webpatser\Uuid\Uuid;

class IdeaController extends Controller
{
    public function start(Request $request) {

        if (Cookie::get('id') === null) {
            $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        } else {
            $id = Cookie::get('id');
        }

        $user = User::find($id);
        if (is_null($user)) {
            $this->createUser($id);
        }

        return redirect("idea/next?message=how-to")
            ->withCookie(cookie()->forever('id', $id));

    }

    private function createUser($id) {
        $user = new User();
        $user->id = $id;
        $user->name = str_random(10);
        $user->password = bcrypt(str_random(10));
        $user->save();
        return $user;
    }

    public function show($id) {
        if (Cookie::get('id') === null) {
            return redirect()->route('idea.start');
        }

        $data['idea'] = Idea::find($id);
        $data['totalStep'] = Auth::check() ? 10 : 5;
        $data['countAction'] = UserAction::count(Cookie::get('id')) % UserAction::$LIMIT + 1;
        $this->updateCounter($id, 'viewed');
        return view('show_idea')->with($data);
    }

    private function getFunFact()
    {
        $funFacts = [
            ['url_image' => 'img/funfact/1.gif', 'fact' => 'We pay salary, but we don’t take any'],
            ['url_image' => 'img/funfact/2.gif', 'fact' => 'Mid 20’s, young and Entrepreneurs too but we don’t have a girlfriend'],
            ['url_image' => 'img/funfact/imagination.gif', 'fact' => 'Talk about millions and billions when we even don’t have thousands.'],
            ['url_image' => 'img/funfact/4.gif', 'fact' => 'Business plan document, plan about what?'],
            ['url_image' => 'img/funfact/5.gif', 'fact' => 'We say F word more often when we become founder'],
            ['url_image' => 'img/funfact/6.gif', 'fact' => 'Too many startup founder biographies need to be read'],
            ['url_image' => 'img/funfact/7.gif', 'fact' => 'Startup Founder: Felt comfortable to sleep with laptop rather than the pillow'],
            ['url_image' => 'img/funfact/8.gif', 'fact' => 'Build startup: drive so far, in the winding road, without certain destination'],
            ['url_image' => 'img/funfact/9.jpeg', 'fact' => ''],
            ['url_image' => 'img/funfact/10.jpeg', 'fact' => ''],
            ['url_image' => 'img/funfact/11.jpeg', 'fact' => ''],
            ['url_image' => 'img/funfact/12.jpeg', 'fact' => ''],
            ['url_image' => 'img/funfact/13.jpeg', 'fact' => ''],
            ['url_image' => 'img/funfact/14.jpeg', 'fact' => ''],
            ['url_image' => 'img/funfact/15.jpeg', 'fact' => '']
        ];

        $idx = rand(0,14);

        return $funFacts[$idx];
    }

    public function next(Request $request) {
        $nextIdea = Idea::next(Cookie::get('id'));
        $countAction = UserAction::count(Cookie::get('id'));

        if (is_null($nextIdea)) {
            return view('finish')
                ->with('countAction', $countAction);

        } else if ($countAction >= UserAction::$TRIAL_LIMIT && !Auth::check()) {
            return view('need_login');

        } else if ($countAction != 0 &&
            ($countAction % UserAction::$LIMIT) == 0 &&
            $countAction != UserAction::$TRIAL_LIMIT
        ) {
            $data['countAction'] = $countAction;
            $data['isFunFact'] = rand(0,1) == 1 ? true : false;
            $data['funFact'] = $this->getFunFact();
            $data['totalStep'] = Auth::check() ? 10 : 5;

            return view('want_more')
                ->with($data);
        } else {

            return redirect()->route('idea.show', [$nextIdea->id])
                ->with('message', $request->message);
        }
    }

    public function trySubmit() {
        return view('coming_soon');
    }

    public function needLogin() {
        return view('need_login');
    }

    public function funFact(Request $request) {

        $countAction = UserAction::where('user_id', Cookie::get('id'))->count();
        return view('want_more')->with('idea_count', $countAction);
    }

    public function wantMore() {
        $nextIdea = Idea::next(Cookie::get('id'));

        if (is_null($nextIdea)) {
            return view('finish')->with('idea_count', Idea::all()->count());
        } else {
            return redirect()->route('idea.show', [$nextIdea->id]);
        }

    }

    public function store(Request $request) {
        $newIdea = new Idea();
        $newIdea->name = $request->name;
        $newIdea->description = $request->description;
        $newIdea->owner = $request->owner;
        $newIdea->save();
        return back();
    }

    public function like(Request $request) {
        $this->updateCounter($request->id, 'like');
        return redirect()->route('idea.next');
    }

    public function skip(Request $request) {
        $this->updateCounter($request->id, 'skip');
        return redirect()->route('idea.next');
    }

    private function updateCounter($id, $type) {
        $idea = Idea::find($id);
        $idea->{$type} = $idea->{$type} + 1;
        $idea->save();

        if ($type != 'viewed') {
            $value = $type == 'like' ? 1 : -1;
            $this->addAction($id, $value);
        }
    }

    private function addAction($idea_id, $value) {
        $action = new UserAction();
        $action->user_id = Cookie::get('id');
        $action->idea_id = $idea_id;
        $action->val = $value;
        $action->save();
    }
}
