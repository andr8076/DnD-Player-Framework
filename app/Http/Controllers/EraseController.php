<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Request;
use App\Character;
use App\Inventory;
use App\Item;
use App\Story;
use App\Storyitems;
use Illuminate\Support\Facades\Validator;

class EraseController extends Controller {

	public function deletelocation($story,$id) {
		$stories = Storyitems::find($id);
		$stories->delete();

		return redirect::to("/stories/" . $story);
	}
	public function deletestory($id) {
		$story = Story::find($id);
		unlink(substr($story->img, 1));
		$story->delete();

		$stories = Storyitems::where('story_id', $id)->get();
		foreach ($stories as $key => $data) {
			if ($data->img != null) {
				unlink(substr($data->img, 1));
			}
			$data->delete();
		}

		return redirect::to("/stories");
	}
	public function deletecustomitem($id) {
		$story = Storyitems::find($id);
		$id = $story->story_id;
		unlink(substr($story->img, 1));
		$story->delete();

		return redirect::to("/stories/" . $id);
	}
}
