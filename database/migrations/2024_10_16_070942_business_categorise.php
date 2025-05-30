<?php

use App\Http\Controllers\settings\BusinessCategories;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("business_categories",function(Blueprint $table){
         $table->id();
         $table->string('name',100);
         $table->integer('main_category_id',10);
         $table->integer('order',10);
         $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('business_categories');
    }
};
