<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Collection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partition_id')->unsigned();
            $table->foreign('partition_id')->references('id')->on('partition')->onDelete('cascade');
            $table->string('name');
            $table->smallInteger('year');
            $table->string('url');
            $table->string('seo_title');
            $table->string('seo_description');
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
