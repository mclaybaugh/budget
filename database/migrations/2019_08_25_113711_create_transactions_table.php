<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Transactions for monthly budgeting and cash-flow.
 */
class CreateTransactionsTable extends Migration {

  public function up() {
    Schema::create('transactions', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();

      /* foreign key to user id */
      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')
        ->references('id')->on('users')
        ->onDelete('cascade');

      $table->text('description');
      $table->decimal('amount', 8, 2);
      $table->dateTime('datetime');

      $table->unsignedBigInteger('category_id');
      $table->foreign('category_id')
        ->references('id')->on('categories')
        ->onDelete('restrict');
    });
  }

  public function down() {
    Schema::dropIfExists('transactions');
  }

}
