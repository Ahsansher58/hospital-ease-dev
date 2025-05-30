<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::table('business_listings', function (Blueprint $table) {
      $table->string('slug')->unique()->after('business_name'); // Add 'slug' column after 'name'
    });
  }

  public function down()
  {
    Schema::table('business_listings', function (Blueprint $table) {
      $table->dropColumn('slug');
    });
  }
};
