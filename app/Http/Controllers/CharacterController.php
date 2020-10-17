<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use App\Character;
use App\Inventory;
use App\Item;
use App\Games;
use App\Collum;
use App\Ref;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CharacterController extends Controller {

	public function profile($id) {
		//check if user owns character

    $chrid = $id;

    $profile = Character::find($chrid);

    $items = Inventory::where('character_id', $chrid)->get();

		$datacollums = Collum::where('character_id', $chrid)->get();

		$data_ref = array();
		foreach ($datacollums as $key => $collum) {
			$data_ref[$collum->id] = Ref::where('collum_id', $collum->id)->get();
		}

		return View('Characters.Character')
						->with('profile', $profile)
						->with('items', $items)
						->with('collums', $datacollums)
						->with('col_refs', $data_ref);
	}

	public function newprofile() {
		return view('Characters.new');
	}

	public function postnewcharacter(Request $request) {

		$messages = array(
			// 'min' => 'Dette felt skal mindst være :min tegn.',
			// 'max' => 'Du må max skrive :max tegn.',
			// 'required' => 'Skal udfyldes',
			// 'regex' => 'Brug kun bogstaver og tal',
		);
		$validator = Validator::make($request->all(), array(
			'name' => 'required|min:2|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'race' => 'required|max:11|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'class' => 'required|max:32|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'background' => 'required|max:32|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'speed' => 'required|max:5|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'level' => 'required|max:9999999999|numeric',
			'inti' => 'required|max:999|numeric',
			'pbonus' => 'required|max:9999999999|numeric',
			'hitp' => 'required|max:9999999999|numeric',
			'hdice' => 'required|max:6|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'ac' => 'required|max:999|numeric',
			'str' => 'required|max:9999999999|numeric',
			'dex' => 'required|max:9999999999|numeric',
			'con' => 'required|max:9999999999|numeric',
			'ine' => 'required|max:9999999999|numeric',
			'wis' => 'required|max:9999999999|numeric',
			'cha' => 'required|max:9999999999|numeric',
		), $messages);
		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			$data = new Character;
			$data->user_id					  	= Auth::user()->id;
			$data->name 							  = $request->input('name');
			$data->race 							  = $request->input('race');
			$data->class 								= $request->input('class');
			$data->background 				  = $request->input('background');
			$data->speed 								= $request->input('speed');
			$data->level 								= $request->input('level');
			$data->initiative 				  = $request->input('inti');
			$data->proficiency_bonus    = $request->input('pbonus');
			$data->hit_points 			  	= $request->input('hitp');
			$data->hit_dice 				  	= $request->input('hdice');
			$data->AC	 									= $request->input('ac');
			$data->STR 									= $request->input('str');
			$data->DEX					 		    = $request->input('dex');
			$data->CON 									= $request->input('con');
			$data->INE 									= $request->input('ine');
			$data->WIS 									= $request->input('wis');
			$data->CHA 									= $request->input('cha');

			if ($request->hasFile('image')) {
					if ($request->file('image')->isValid()) {
							//
							$validated = $request->validate([
									'image' => 'mimes:jpeg,png',
							]);
							$filename = md5(microtime());
							$extension = $request->image->extension();
							$request->image->move(public_path('img/characters/'), $filename.".".$extension);
							$url = "/img/characters/".$filename.".".$extension;

							$data->img = $url;
						}
				}
			}
			if (!$data->save()) {
				return "Data error in controller";
			} else {
				$character_id = Character::where('name', $request->input('name'))->first()->id;
				return Redirect::to('/character/box/'.$character_id);
			}
		}

		public function managecollums($id) {
			$character = Character::find($id);
			return view('characters.box')->with('id', $id)->with('character', $character);
		}

		public function characterbox(Request $request) {
			$newitem = new Collum;
			$newitem->character_id = $request->input('CharacterID');
			$newitem->title = $request->input('title');
			$newitem->side = $request->input('side');
			$newitem->save();
			exit;
		}
		public function charactercontent(Request $request) {
			$newitem = new Ref;
			$newitem->collum_id = $request->input('box_id');
			$newitem->title = $request->input('title');
			$newitem->style = $request->input('style');
			$newitem->text = $request->input('text');
			$newitem->save();
			exit;
		}
		public function getboxlist($id = 0) {
	    if ($id != 0) {
				$query = Collum::where('character_id', $id)->get();
				$data = array();
				foreach ($query as $key => $value) {
					array_push($data, $value->id.":". $value->title);
				}
		    echo json_encode($data);
	    }
	    exit;
		}
}
