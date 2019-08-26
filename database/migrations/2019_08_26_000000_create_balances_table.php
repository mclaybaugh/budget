<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Stores account balances used for calculating budget items.
 */
class CreateBalancesTable extends Migration {

  /**
   * Run the migrations.
   */
  public function up() {
    Schema::create('balances', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->foreign('user_id')
        ->references('id')->on('users')
        ->onDelete('cascade');
      $table->decimal('amount', 8, 2);
      $table->dateTime('datetime');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down() {
    Schema::dropIfExists('balances');
  }

}
