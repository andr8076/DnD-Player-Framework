<?php

namespace App\Http\Controllers;

use Auth;
use Request;
Use Redirect;
use App\Character;
use App\Inventory;
use App\Item;
use App\Games;
use App\Collum;
use App\Ref;
use App\Story;
use App\StoryLocations;
use Illuminate\Support\Facades\Validator;


class GameController extends Controller {

	public function DMaster($gameid) {
    $game = Games::find($gameid);
		$story = Story::find($game->story_id);
		$locations = StoryLocations::where('story_id', $story->id)->get();

    $players = Character::where('game_id', $gameid)->get();

		return View('dungeonmaster.dungeonmaster')
					 ->with('game', $game)
					 ->with('players', $players)
					 ->with('story', $story)
					 ->with('locations', $locations);
  }
  public function generateLoot($gameid) {
    $roomlevel = 2; // fetch this from "current" room. (dashboard probably)

    $allloot = Item::where('level', "<=", $roomlevel)->get();
    $numberOfItems = rand(0,5);
    $loot = array();
    for ($i=0; $i < $numberOfItems; $i++) {
      $newloot = $allloot[rand(0,count($allloot)-1)];
      if (!in_array($newloot, $loot)) {
        array_push($loot, $newloot);
      };
    }

    $players = Character::where('game_id', $gameid)->get();

    return View("functions.generateloot")->with('loot', $loot)->with('players', $players)->with('gameid', $gameid);
  }
  public function giveloot() {
		//CHECK IF CHARACTER IS IN GAME BEFORE GIVING

		$newitem = new Inventory;
		$newitem->character_id = Input::get('character');
		$newitem->item_id = Input::get('item');
		$newitem->level = Input::get('level');
		$newitem->save();
  }
	public function getDMStoryitem($id = 0) {
		if ($id != 0) {
			$query = StoryLocations::find($id);
			echo json_encode($query->storytext);
		}
		exit;
	}
	public function getDMStory($id = 0) {
		if ($id != 0) {
			$query = Story::find($id);
			echo json_encode($query->description);
		}
		exit;
	}

}
