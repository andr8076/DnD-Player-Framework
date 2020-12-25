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
use App\StoryNpc;
use App\StoryItems;
//use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller {

	public function DMaster($gameid) {
    $game = Games::find($gameid);
		$story = Story::find($game->story_id);
		$locations = StoryLocations::where('story_id', $story->id)->get();
    $players = Character::where('game_id', $gameid)->get();
		$npc = Storynpc::where('story_id', $story->id)->get();
		$storyitems = Storyitems::where('story_id', $story->id)->get();

		return View('dungeonmaster.dungeonmaster')
					 ->with('game', $game)
					 ->with('players', $players)
					 ->with('story', $story)
					 ->with('locations', $locations)
					 ->with('npc', $npc)
					 ->with('items', $storyitems);
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
	public function playersInventory($id) {
		$game = Games::find($id);
		$players = Character::where('game_id', $id)->get();
		$items = Item::get();
		$storyitems = StoryItems::get();

		$sql = new Inventory;
		foreach ($players as $select) {
		   $sql = $sql->orWhere('character_id', '=', $select->id);
		}
		$result = $sql->get();

		return View('dungeonmaster.inventory')
					->with('players', $players)
					->with('inventory', $result)
					->with('game', $game)
					->with('generalitems', $items)
					->with('storyitems', $storyitems);
	}
  public function giveloot() {
		//CHECK IF CHARACTER IS IN GAME BEFORE GIVING

		$newitem = new Inventory;
		$newitem->character_id = Request::get('character');
		$newitem->item_id = Request::get('item');
		$newitem->save();
  }
	public function showmap($id = 0) {
		if (empty($id)) {
			return Redirect::to('/');
		}
		$game = Games::find($id);
		return View('dungeonmaster.map')->with('game', $game);
	}
	public function getDMStoryBox($id = 0) {
		if ($id != 0) {
			$query = StoryLocations::find($id);

			$mapchange = Story::find($query->story_id);
			$mapchange->active_location = $query->id;
			$mapchange->save();

			echo json_encode($query);
		}
		exit;
	}
	public function getDMStoryNPC($id = 0) {
		if ($id != 0) {
			$query = StoryNpc::where('story_id', $id)->get();
			echo json_encode($query);
		}
		exit;
	}
	public function getDMStoryItem($id = 0) {
		if ($id != 0) {
			$query = StoryItems::where('story_id', $id)->get();
			echo json_encode($query);
		}
		exit;
	}
	// public function getDMStoryNote($id = 0) {
	// 	if ($id != 0) {
	// 		$query = "dis note here"; //StoryItems::where('story_id', $id)->get();
	// 		echo json_encode($query);
	// 	}
	// 	exit;
	// }
	public function getDMStoryImg($id = 0) {
		if ($id != 0) {
			$game = Games::find($id);
			$story = Story::find($game->story_id);
			$location = StoryLocations::find($story->active_location);
			echo json_encode(substr($location->img, 1));
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
	public function eraseitem() {
		$item = Inventory::find(Request::get('deleteid'));
		$item->active = 0;
		$item->save();
	}
	public function returnitem() {
		$item = Inventory::find(Request::get('returnid'));
		$item->active = 1;
		$item->save();
	}
}
