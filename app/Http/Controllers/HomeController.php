<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;
use App\Games;
use App\User;
use App\Story;
use App\Character;

class HomeController extends Controller {
    public function index() {
      if (!Auth::check()) {
        return Redirect::to('/login');
      }
      $activegames = Games::where('user_id', Auth::user()->id)->get();
      $storys = Story::where('user_id', Auth::user()->id)->get();
      $characters = Character::where('user_id', Auth::user()->id)->get();
      $users = User::get();

      $data = array('activegames' => $activegames,
                         'storys' => $storys,
                     'characters' => $characters,
                          'users' => $users);


        return view('index')->with('data', $data);
    }

		public function store (Request $request) {

        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                //
                $validated = $request->validate([
                    'name' => 'string|max:40',
                    'image' => 'mimes:jpeg,png',
                ]);
                $extension = $request->image->extension();
                $request->image->move(public_path('img'), $validated['name'].".".$extension);
                $url = "/img/".$validated['name'].".".$extension;

								$file = new File;
                $file->name = $validated['name'];
              	$file->url = $url;
                $file->save();

                return \Redirect::back();
            }
        }
        abort(500, 'Could not upload image :(');
    }

    public function viewUploads () {
        $images = File::all();
        return view('view_uploads')->with('images', $images);
    }
}
