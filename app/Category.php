<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
  public static function getArray() {
    $records = Category::all();
    $cats = [];
    foreach ($records as $cat) {
      $cats[$cat->id] = $cat->name;
    }
    return $cats;
  }
}
