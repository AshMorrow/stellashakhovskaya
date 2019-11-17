<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CollectionsMain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections_main', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('photo_front')->default('front');
            $table->string('photo_back')->default('back');
            $table->string('url');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('collections_main');
    }
}
