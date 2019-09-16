<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Bills, income, and various other expenses used for budget template.
 */
class CreateTemplatesTable extends Migration {

  public function up() {
    Schema::create('templates', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();

      /* foreign key to user id */
      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')
        ->references('id')->on('users')
        ->onDelete('cascade');

      $table->unsignedBigInteger('category_id');
      $table->foreign('category_id')
        ->references('id')->on('categories')
        ->onDelete('restrict');

      $table->char('description', 100);
      $table->decimal('amount', 8, 2);
      $table->dateTime('datetime');
    });
  }

  public function down() {
    Schema::dropIfExists('templates');
  }

}
