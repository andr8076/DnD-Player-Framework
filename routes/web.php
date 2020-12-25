<?php

use Illuminate\Support\Facades\Route;



// Not logged in
Route::group(array('before' => 'guest'), function(){
	Route::get('/login', 'LoginController@login');

	Route::group(array('before' => 'csrf'), function(){
		Route::post('/login', array('uses' => 'LoginController@postLogin', 'as' => 'postLogin'));
	});
});
// Logged in
Route::group(array('before' => 'auth'), function(){
  Route::get('/logout', 'LoginController@logout');
  Route::get('/', 'HomeController@index');
	Route::get('/character/new', 'CharacterController@newprofile');
	Route::get('/character/box/{id}', 'CharacterController@managecollums');
	Route::get('/character/{id}', 'CharacterController@profile');

	Route::get('/stories', 'StoryController@allstories');
	Route::get('/stories/new', 'StoryController@newstories');
	Route::get('/stories/{id}', 'StoryController@viewstories');
	Route::get('/stories/locations/new/{id}', 'StoryController@newlocations');
	Route::get('/stories/locations/{id}', 'StoryController@editlocations');
	Route::get('/stories/item/new/{id}', 'StoryController@createcustomitem');
	Route::get('/stories/item/{id}', 'StoryController@editcustomitem');
	Route::get('/stories/npc/new/{id}', 'StoryController@createnpc');
	Route::get('/stories/npc/{id}', 'StoryController@editnpc');

  Route::get('/DM/{game}', 'GameController@DMaster');
  Route::get('/DM/{game}/loot', 'GameController@generateLoot');
	Route::get('/map/{id}', 'GameController@showmap');
	Route::get('/inventory/{id}', 'GameController@playersInventory');

	Route::get('/delete/stories/locations/{story}/{id}', 'EraseController@deletelocation');
	Route::get('/delete/stories/{id}', 'EraseController@deletestory');
	Route::get('/delete/stories/item/{id}', 'EraseController@deletecustomitem');

  //ajax START routes
	Route::get('/getboxlist/{id}', 'CharacterController@getboxlist');
	Route::get('/getDMStory/{id}', 'GameController@getDMStory');
	Route::get('/getDMStoryBox/{id}', 'GameController@getDMStoryBox');
	Route::get('/getDMStoryNPC/{id}', 'GameController@getDMStoryNPC');
	Route::get('/getDMStoryItem/{id}', 'GameController@getDMStoryItem');
	// Route::get('/getDMStoryNote/{id}', 'GameController@getDMStoryNote');
	Route::get('/getDMStoryImg/{id}', 'GameController@getDMStoryImg');

	Route::post('/deleteitem', array('as'=>'post', 'uses'=>'GameController@eraseitem'));
	Route::post('/returnitem', array('as'=>'post', 'uses'=>'GameController@returnitem'));
  Route::post('/giveloot', array('as'=>'post', 'uses'=>'GameController@giveloot'));
	Route::post('/characterbox', array('as'=>'post', 'uses'=>'CharacterController@characterbox', 'as' => 'characterbox'));
	Route::post('/charactercontent', array('as'=>'post', 'uses'=>'CharacterController@charactercontent', 'as' => 'charactercontent'));
	//ajax END routes

  Route::group(array('before' => 'csrf'), function(){
  	//Route::post('/postimage', array('uses' => 'HomeController@postimage', 'as' => 'postimage'));
		Route::post('/postnewcharacter', array('uses' => 'CharacterController@postnewcharacter', 'as' => 'postnewcharacter'));
		Route::post('/postnewstory', array('uses' => 'StoryController@postnewstory', 'as' => 'postnewstory'));
		Route::post('/postlocations', array('uses' => 'StoryController@postlocations', 'as' => 'postlocations'));
		Route::post('/postnewlocations', array('uses' => 'StoryController@postnewlocations', 'as' => 'postnewlocations'));
		Route::post('/postnewitem', array('uses' => 'StoryController@postnewitem', 'as' => 'postnewitem'));
		Route::post('/posteditcustomitem', array('uses' => 'StoryController@posteditcustomitem', 'as' => 'posteditcustomitem'));
		Route::post('/postnewcustomnew', array('uses' => 'StoryController@postnewcustomnew', 'as' => 'postnewcustomnew'));
		Route::post('/posteditcustomnew', array('uses' => 'StoryController@posteditcustomnew', 'as' => 'posteditcustomnew'));

  });
});

// Route::get('/', 'HomeController@index');
// Route::get('/view-uploads', 'HomeController@viewUploads');
// Route::post('/file-upload', 'HomeController@store');
//
//
// Route::group(array('before' => 'guest'), function(){
// 	Route::get('/login', 'UserController@login');
//
// 	Route::group(array('before' => 'csrf'), function(){
// 		Route::post('/login', array('uses' => 'UserController@postLogin', 'as' => 'postLogin'));
// 	});
// });
//
//
// Route::group(array('before' => 'auth'), function(){
//   Route::get('/logout', 'UserController@logout');
//
//   if (isset(Auth::user()->admin) && Auth::user()->admin) {
// 		//admin routes
//   }
//
//   Route::group(array('before' => 'csrf'), function(){
//     //Post's
//
//     if (isset(Auth::user()->admin) && Auth::user()->admin) {
// 			//admin Post's
//     }
// 	});
// });
