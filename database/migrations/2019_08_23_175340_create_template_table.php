<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Bills, income, and various other expenses used for budget template.
 */
class CreateTemplateTable extends Migration {

  /**
   * If interval_days is 0, then transaction is monthly.
   */
  public function up() {
    Schema::create('template', function (Blueprint $table) {
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

      $table->unsignedBigInteger('category_id');
      $table->foreign('category_id')
        ->references('id')->on('categories')
        ->onDelete('restrict');
    });
  }

  public function down() {
    Schema::dropIfExists('template');
  }

}
