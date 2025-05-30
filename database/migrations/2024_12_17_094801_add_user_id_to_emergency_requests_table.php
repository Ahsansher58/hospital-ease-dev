<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::table('emergency_requests', function (Blueprint $table) {
      $table->unsignedBigInteger('user_id')->nullable();

      // Optionally, add a foreign key constraint to the users table
      $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    });
  }

  public function down()
  {
    Schema::table('emergency_requests', function (Blueprint $table) {
      $table->dropForeign(['user_id']);
      $table->dropColumn('user_id');
    });
  }
};
