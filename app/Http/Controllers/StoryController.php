<?php

namespace App\Http\Controllers;

use Auth;
Use Redirect;
use App\Character;
use App\Inventory;
use App\Item;
use App\Story;
use App\StoryLocations;
use App\StoryItems;
use App\StoryNpc;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StoryController extends Controller {

	public function allstories() {
		$stories = Story::where('user_id', Auth::user()->id)->get();

		return View('stories.all')->with('stories', $stories);
	}

	public function newstories() {
		return View('stories.new');
	}

	public function postnewstory(Request $request) {

		$messages = array(
			// 'min' => 'Dette felt skal mindst være :min tegn.',
			// 'max' => 'Du må max skrive :max tegn.',
			// 'required' => 'Skal udfyldes',
			// 'regex' => 'Brug kun bogstaver og tal',
		);
		$validator = Validator::make($request->all(), array(
			'name' => 'required|min:2|max:32|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'desc' => 'required|max:64|min:5|regex:/(^[A-Za-z0-9æøå ]+$)+/',
		), $messages);
		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			//save data
			$data = new Story;
			$data->user_id = Auth::user()->id;
			$data->name = $request->input('name');
			$data->description = $request->input('desc');

				if ($request->hasFile('image')) {
					if ($request->file('image')->isValid()) {
							$validated = $request->validate([
									'image' => 'mimes:jpeg,png',
							]);
							$filename = md5(microtime());
							$extension = $request->image->extension();
							$request->image->move(public_path('img/storys/'), $filename.".".$extension);
							$url = "/img/storys/".$filename.".".$extension;

							$data->img = $url;
						}
				}

			}
			if (!$data->save()) {
				return "Data error in controller";
			} else {
				//dd(Story::where('name', $request->input('name'))->where('user_id', Auth::user()->id)->first();
				return Redirect::to('/stories');
			}
	}
	public function viewstories($id) {
		$story = Story::find($id);
		$locations = StoryLocations::where('story_id', $id)->orderBy('story_order')->get();
		$customitems = StoryItems::where('story_id', $id)->get();
		$customnpc = StoryNpc::where('story_id', $id)->get();


		return View('stories.view')
				 ->with('story', $story)
				 ->with('locations', $locations)
				 ->with('items', $customitems)
				 ->with('npc', $customnpc);
	}

	public function newlocations($id) {
		$story = Story::find($id);

		return View('stories.locationnew')->with('story', $story);
	}

	public function editlocations($id) {
		$item = StoryLocations::find($id);

		return View('stories.locationedit')->with('item', $item);
	}

	public function postnewlocations(Request $request) {
		$messages = array(
			// 'min' => 'Dette felt skal mindst være :min tegn.',
			// 'max' => 'Du må max skrive :max tegn.',
			// 'required' => 'Skal udfyldes',
			// 'regex' => 'Brug kun bogstaver og tal',
		);
		$validator = Validator::make($request->all(), array(
			'title' => 'required|min:2|max:32|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'text' => 'required|min:5',
		), $messages);
		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			//save data
			$new_order = StoryLocations::where('story_id', $request->input('id'))->orderBy('story_order', 'DESC')->first();
			if (!empty($new_order) && $new_order->story_order > 0) {
				$new_order = $new_order->story_order + 1;
			} else {
				$new_order = 1;
			}

			$data = new StoryLocations;
			$data->story_order = $new_order;
			$data->story_id = $request->input('id');
			$data->title = $request->input('title');
			$data->storytext = $request->input('text');

				if ($request->hasFile('image')) {
					if ($request->file('image')->isValid()) {
							$validated = $request->validate([
									'image' => 'mimes:jpeg,png',
							]);
							$filename = md5(microtime());
							$extension = $request->image->extension();
							$request->image->move(public_path('img/storys/'), $filename.".".$extension);
							$url = "/img/storys/".$filename.".".$extension;
							$data->img = $url;
						}
				} else {
					$data->img = null;
				}

			}
			if (!$data->save()) {
				return "Data error in controller";
			} else {
				return Redirect::to("/stories/" . $request->input('id'));
			}
	}

	public function postlocations(Request $request) {
		$messages = array(
			// 'min' => 'Dette felt skal mindst være :min tegn.',
			// 'max' => 'Du må max skrive :max tegn.',
			// 'required' => 'Skal udfyldes',
			// 'regex' => 'Brug kun bogstaver og tal',
		);
		$validator = Validator::make($request->all(), array(
			'title' => 'required|min:2|max:32|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'text' => 'required|min:5',
		), $messages);
		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			//save data
			$data = StoryLocations::find($request->input('id'));
			$data->title = $request->input('title');
			$data->storytext = $request->input('text');

				if ($request->hasFile('image')) {
					if ($request->file('image')->isValid()) {
						$validated = $request->validate([
								'image' => 'mimes:jpeg,png',
						]);
						$filename = md5(microtime());
						$extension = $request->image->extension();
						$request->image->move(public_path('img/storys/'), $filename.".".$extension);
						$url = "/img/storys/".$filename.".".$extension;
						@unlink(substr($data->img, 1));
						$data->img = $url;
					}
				}
			}
			if (!$data->save()) {
				return "Data error in controller";
			} else {
				return Redirect::to("/stories/" . $request->input('story_id'));
			}
	}
	public function createcustomitem($id) {
		return View('stories.itemnew')->with('id', $id);
	}
	public function postnewitem(Request $request) {
		$messages = array(
			'dimensions' => 'Image too large. Max size is 512px by 512px',
			// 'min' => 'Dette felt skal mindst være :min tegn.',
			// 'max' => 'Du må max skrive :max tegn.',
			// 'required' => 'Skal udfyldes',
			// 'regex' => 'Brug kun bogstaver og tal',
		);
		$validator = Validator::make($request->all(), array(
			'name' => 'required|min:2|max:64|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'text' => 'required|min:5',
			'image' => 'required|dimensions:max_height=512,max_width=512'
		), $messages);
		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			//save data
			$data = new StoryItems;
			$data->name = $request->input('name');
			$data->notes = $request->input('text');
			$data->story_id = $request->input('story_id');

				if ($request->hasFile('image')) {
					if ($request->file('image')->isValid()) {
						$validated = $request->validate([
								'image' => 'mimes:jpeg,png,gif',
						]);
						$filename = md5(microtime());
						$extension = $request->image->extension();
						$request->image->move(public_path('img/items/custom/'), $filename.".".$extension);
						$url = "/img/items/custom/".$filename.".".$extension;
						$data->img = $url;
					}
				}
			}
			if (!$data->save()) {
				return "Data error in controller";
			} else {
				return Redirect::to("/stories/" . $request->input('story_id'));
			}
	}
	public function editcustomitem($id) {
		$data = StoryItems::find($id);
		return View('stories.itemedit')->with('data', $data);
	}
	public function posteditcustomitem(Request $request) {
		$messages = array(
			'dimensions' => 'Image too large. Max size is 512px by 512px',
			// 'min' => 'Dette felt skal mindst være :min tegn.',
			// 'max' => 'Du må max skrive :max tegn.',
			// 'required' => 'Skal udfyldes',
			// 'regex' => 'Brug kun bogstaver og tal',
		);
		$validator = Validator::make($request->all(), array(
			'name' => 'required|min:2|max:64|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'text' => 'required|min:5',
			'image' => 'dimensions:max_height=512,max_width=512'
		), $messages);
		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			//save data
			$data = StoryItems::find($request->input('id'));
			$data->name = $request->input('name');
			$data->notes = $request->input('text');

				if ($request->hasFile('image')) {
					if ($request->file('image')->isValid()) {
						$validated = $request->validate([
								'image' => 'mimes:jpeg,png,gif',
						]);
						$filename = md5(microtime());
						$extension = $request->image->extension();
						$request->image->move(public_path('img/items/custom/'), $filename.".".$extension);
						$url = "/img/items/custom/".$filename.".".$extension;
						unlink(substr($data->img, 1));
						$data->img = $url;
					}
				}
			}
			if (!$data->save()) {
				return "Data error in controller";
			} else {
				return Redirect::to("/stories/" . $request->input('story_id'));
			}
	}
	public function createnpc($id) {
		return View('stories.npcnew')->with('id', $id);
	}
	public function postnewcustomnew(Request $request) {
		$messages = array(
			'dimensions' => 'Image too large. Max size is 1024px by 1024px',
			// 'min' => 'Dette felt skal mindst være :min tegn.',
			// 'max' => 'Du må max skrive :max tegn.',
			// 'required' => 'Skal udfyldes',
			// 'regex' => 'Brug kun bogstaver og tal',
		);
		$validator = Validator::make($request->all(), array(
			'name' => 'required|min:2|max:64|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'text' => 'required|min:5',
			'image' => 'dimensions:max_height=1024,max_width=1024'
		), $messages);
		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			//save data
			$data = new StoryNpc;
			$data->name = $request->input('name');
			$data->text = $request->input('text');
			$data->story_id = $request->input('story_id');

				if ($request->hasFile('image')) {
					if ($request->file('image')->isValid()) {
						$validated = $request->validate([
								'image' => 'mimes:jpeg,png',
						]);
						$filename = md5(microtime());
						$extension = $request->image->extension();
						$request->image->move(public_path('img/npc/custom/'), $filename.".".$extension);
						$url = "/img/npc/custom/".$filename.".".$extension;
						$data->img = $url;
					}
				}
			}
			if (!$data->save()) {
				return "Data error in controller";
			} else {
				return Redirect::to("/stories/" . $request->input('story_id'));
			}
	}

	public function editnpc($id) {
		$data = StoryNpc::find($id);
		return View('stories.npc')->with('data', $data);
	}

	public function posteditcustomnew(Request $request) {
		$messages = array(
			'dimensions' => 'Image too large. Max size is 1024px by 1024px',
			// 'min' => 'Dette felt skal mindst være :min tegn.',
			// 'max' => 'Du må max skrive :max tegn.',
			// 'required' => 'Skal udfyldes',
			// 'regex' => 'Brug kun bogstaver og tal',
		);
		$validator = Validator::make($request->all(), array(
			'name' => 'required|min:2|max:64|regex:/(^[A-Za-z0-9æøå ]+$)+/',
			'text' => 'required|min:5',
			'image' => 'dimensions:max_height=1024,max_width=1024'
		), $messages);
		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		} else {
			//save data
			$data = StoryNpc::find($request->input('id'));
			$data->name = $request->input('name');
			$data->text = $request->input('text');
			$data->story_id = $request->input('story_id');

				if ($request->hasFile('image')) {
					if ($request->file('image')->isValid()) {
						$validated = $request->validate([
								'image' => 'mimes:jpeg,png',
						]);
						$filename = md5(microtime());
						$extension = $request->image->extension();
						$request->image->move(public_path('img/npc/custom/'), $filename.".".$extension);
						$url = "/img/npc/custom/".$filename.".".$extension;
						unlink(substr($data->img, 1));
						$data->img = $url;
					}
				}
			}
			if (!$data->save()) {
				return "Data error in controller";
			} else {
				return Redirect::to("/stories/" . $request->input('story_id'));
			}
	}
}
