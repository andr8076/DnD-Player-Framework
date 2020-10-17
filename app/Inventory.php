<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {
      protected $table = "inventory";

      public function getItemName() {
        return item::find($this->item_id)->name;
      }
}
