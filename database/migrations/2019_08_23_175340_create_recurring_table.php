<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Bills, income, and various other expenses used for budget template.
 */
class CreateRecurringTable extends Migration {

  /**
   * Run the migrations.
   *
   * If interval_days is 0, then transaction is monthly.
   */
  public function up() {
    Schema::create('recurring', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();

      /* foreign key to user id */
      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')
        ->references('id')->on('users')
        ->onDelete('cascade');

      $table->char('description', 100);
      $table->decimal('amount', 8, 2);
      $table->dateTime('datetime');

      /* If interval is 0, then transaction is same day every month */
      $table->integer('interval_days');

      /* Categories are creditcard, loan, utility, variable, income */
      $table->string('category');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down() {
    Schema::dropIfExists('recurring');
  }

}
