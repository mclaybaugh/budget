<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlannedTransaction extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('frequencies', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
    });
    Schema::create('plannedtransactions', function (Blueprint $table) {
      $table->increments('id');
      $table->timestamps();
      $table->text('description');
      $table->decimal('amount', 8, 2);
      // user
      // frequency
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('plannedtransactions');
  }
}
