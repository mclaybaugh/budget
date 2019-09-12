<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Template;

class DatabaseSeeder extends Seeder {

  public function run() {
    $categories = [
      'Income',
      'Utility',
      'Loan',
      'Credit Card',
      'Variable',
    ];
    foreach ($categories as $name) {
      $cat = new Category();
      $cat->name = $name;
      $cat->save();
    }
  }

}
