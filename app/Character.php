<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model {
      protected $table = "characters";

      public function getItemName() {
        return Item::find($this->item_id)->name;
      }
}
