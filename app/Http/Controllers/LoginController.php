<?php

namespace App\Http\Controllers;

use Auth;
use Request;
Use Redirect;
use App\User;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller {

	public function login() {
		// if (!Session::has('login_attempt')) {
		// 	Session::put('login_attempt', 0);
		// } else {
		// 	if (Session::get('login_attempt') > 2) {
		// 		return View::make('errors.404');
		// 	}
		// }
		return \View::make('users.login');
	}

	public function postLogin() {
    $messages = array(
				'regex' => 'Brug kun bogstaver og tal',
        'required' => 'Skal udfyldes',
		);
		$validator = Validator::make(Request::all(), array(
			'username' => 'required|regex:/^\S*$/u',
			'password' => 'required'
		), $messages);
		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator->messages())
				->withInput(Request::all());
		} else {
			$userdata = array(
				'username' => Request::get('username'),
				'password' => Request::get('password')
			);
			if (Auth::attempt($userdata, true)) {
				$user = User::find(Auth::user()->id);
				$user->last_login = date("Y-m-d H:i:s");
				$user->increment('login_count');
				$user->save();

				return Redirect::to('/');
			} else {
				return Redirect::to('/login')->withError('Forkert Brugernavn eller Kodeord');
			}
		}
	}
	public function logout() {
		Auth::logout();
		return Redirect::to('/');
	}

	// public function MetaUser($id) {
	// 	$user = User::find($id);
	// 	$publisher = Publishers::find($user->publisher_id);
	// 	$usercards = Completions::where('publisher_id', $user->publisher_id)->where('date_end', '0000-00-00')->get();
	//
	// 	return View::make('user.singleuser')->withUser($user)->withPublisher($publisher)->withUsercards($usercards);
	// }
	//
	// public function newMetaUser() {
	// 	$allpub = Publishers::orderBy('first_name')->get();
	//
	// 	return View::make('user.newmeta')->withAllusers($allpub);
	// }
	//
	// public function metaUserAdd() {
	// 	$messages = array(
	// 		'same' => 'Koderne skal være ens.',
	// 		'min' => 'For kort.',
	// 		'unique' => 'Er taget.',
	// 		'regex' => 'Må kun indeholde bogstaver og tal.',
	// 		'required' => 'Skal udfyldes.',
	// 	);
	// 	$validator = Validator::make(Request::all(), array(
	// 		'username' => 'required|unique:plugin_userdata|min:3|regex:/^\S*$/u',
	// 		'publisher_id' => 'required|unique:plugin_userdata',
	// 		'pass1' => 'required|min:5|same:pass2',
	// 		'pass2' => 'required|min:5|same:pass1'
	// 	), $messages);
	// 	if ($validator->fails()) {
	// 			return Redirect::back()
	// 				->withErrors($validator->messages())
	// 				->withInput(Request::all());
	// 	} else {
	// 		$user = new User;
	// 		$user->username = Request::get('username');
	// 		$user->publisher_id = Request::get('publisher_id');
	// 		$user->password = Hash::make(Request::get('pass1'));
	// 		$user->save();
	// 	}
	// 	if ($user) {
	// 		return Redirect::to('/users')->withJs('swal("Velkommen!", "Du kan nu logge ind", "success");');
	// 	} else {
	// 		return "der er opstået en fejl";
	// 	}
	// }
	// public function passwordResetMenu($id) {
	// 	$allpub = Publishers::orderBy('first_name')->get();
	//
	// 	if (Auth::check()) {
	// 		if (Auth::user()->id == $id || Auth::user()->admin) {
	// 			return View::make('user.passwordmenu')->withAllusers($allpub);
	// 		}
	// 	}
	// 	return Redirect::to('/');
	// }
	//
	// public function passwordReset() {
	// 	if (Request::get('publisher_id') == Auth::user()->id || Auth::user()->admin) {
	// 		$messages = array(
	// 			'same' => 'Koderne skal være ens.',
	// 			'min' => 'For kort.',
	// 			'required' => 'Skal udfyldes.',
	// 		);
	// 		$validator = Validator::make(Request::all(), array(
	// 			'pass1' => 'required|min:5|same:pass2',
	// 			'pass2' => 'required|min:5|same:pass1'
	// 		), $messages);
	// 		if ($validator->fails()) {
	// 				return Redirect::back()
	// 					->withErrors($validator->messages())
	// 					->withInput(Request::all());
	// 		} else {
	// 			$user = User::find(Request::get('publisher_id'));
	// 			$user->password = Hash::make(Request::get('pass1'));
	// 			$user->save();
	// 		}
	// 		if ($user) {
	// 			return Redirect::to('/')->withJs('swal("Din kode er ændret", "Vi anbefalder at du logger ud med det samme, for at lade systemet opdatere 100%", "success");');
	// 		} else {
	// 			return "der er opstået en fejl";
	// 		}
	// 	}
	// 	return Redirect::to('/');
	// }
	//
	// public function cards($id) {
	// 	$user = Publishers::find($id);
	// 	$usercards = Completions::where('publisher_id', $user->id)->where('date_end', '0000-00-00')->get();
	//
	//
	// 	return View::make('user.cards')->withUser($user)->withUsercards($usercards);
	// }

//---------------

  //
	// public function registerkey($key) {
	// 	$registerkey = User::where('password_key', $key)->first();
	// 	if (!empty($registerkey->password_key) && $registerkey->password_key == $key) {
	// 		return View::make('cms.login.registerkey')->withKey($registerkey);
	// 	} else {
	// 		return View::make('cms.404');
	// 	}
	// }
  //
	// public function register() {
	// 	if (Settings::where('title', 'register')->first()->setting != 'key') {
	// 		return View::make('cms.login.register');
	// 	} else {
	// 		return View::make('cms.404');
	// 	}
	// }
  //
	// public function postRegister() {
	// 	if (Settings::where('title', 'register')->first()->setting == 'key') {
	// 		$registerkey = User::where('password_key', Request::get('key'))->first();
	// 		if (empty($registerkey->password_key) || $registerkey->password_key != Request::get('key')) {
	// 			return Redirect::to('/')->withError('Key error');
	// 		}
	// 	}
  //
	// 	$messages = array(
	// 		'same' => 'The passwords must match.',
	// 		'min' => 'This field must be at least 6 characters.',
	// 	);
	// 	$validator = Validator::make(Request::all(), array(
	// 		'username' => 'required|unique:users|min:6|regex:/^\S*$/u',
	// 		'email' => 'required|email',
	// 		'pass1' => 'required|min:6|same:pass2',
	// 		'pass2' => 'required|min:6|same:pass1'
	// 	), $messages);
	// 	if ($validator->fails()) {
	// 		if (Settings::where('title', 'register')->first()->setting == 'key') {
	// 			return Redirect::to('/register/' . Request::get('key'))
	// 				->withErrors($validator->messages())
	// 				->withInput(Request::all());
	// 		} else {
	// 			return Redirect::to('/register')
	// 				->withErrors($validator->messages())
	// 				->withInput(Request::all());
	// 		}
	// 	} else {
	// 		$user = new User;
	// 		$user->username = Request::get('username');
	// 		$user->password = Hash::make(Request::get('pass1'));
	// 		$user->email = Request::get('email');
	// 		$user->save();
  //
	// 		if (Settings::where('title', 'register')->first()->setting == 'key') {
	// 			User::destroy($registerkey->id);
	// 		}
  //
	// 	}
	// 	if ($user) {
	// 		return Redirect::to('/login')->withJs('swal("Welcome!", "User has been created! You can now login", "success");');
	// 	} else {
	// 		return "der er opstået en fejl";
	// 	}
	// }
  //
	// public function viewuser($id) {
	// 	$user = User::find($id);
  //
	// 	return View::make('cms.login.view')->withUser($user);
	// }
  //
	// public function newUserKey() {
	// 	$registerKey = new User;
	// 	$registerKey->password_key = md5(microtime());
	// 	$registerKey->save();
  //
	// 	return Redirect::to('/cms')->withJs('swal("Success!", "Key has created!\nClick on it to get the link and send it.", "success");');
	// }
  //
	// public function deleteuser($id) {
	// 	User::destroy($id);
	// 	return Redirect::to('/cms')->withJs('swal("Success!", "User has been deleted", "success");');
	// }
  //
	// public function deleteUserKey($key) {
	// 	User::where('password_key', $key)->delete();
	// 	return Redirect::to('/')->withJs('swal("Success!", "The key has been deleted", "success");');
	// }
  //
}
