<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
  public function up()
  {
    Schema::create('settings', function (Blueprint $table) {
      $table->id();
      $table->string('option')->unique(); // Unique setting name
      $table->text('value')->nullable(); // Value of the setting
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('settings');
  }
}
