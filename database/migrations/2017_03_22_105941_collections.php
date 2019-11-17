<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Collections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cm_id')->unsigned();
            $table->foreign('cm_id')->references('id')->on('collections_main')->onDelete('cascade');
            $table->string('name');
            $table->smallInteger('year');
            $table->string('url');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('photo_front')->default('front');
            $table->string('photo_back')->default('back');
            $table->boolean('is_archived')->default(0);

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections', function (Blueprint $table) {
            //
        });
    }
}
