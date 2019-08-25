<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlannedTransaction extends Migration {

  /**
   * Run the migrations.
   *
   * If interval_days is 0, then transaction is monthly.
   */
  public function up() {
    Schema::create('plannedtransactions', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->foreign('user_id')
        ->references('id')->on('users')
        ->onDelete('cascade');
      $table->text('description');
      $table->decimal('amount', 8, 2);
      $table->dateTime('datetime');
      $table->integer('interval_days');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down() {
    Schema::dropIfExists('plannedtransactions');
  }

}
