<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagOutfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_outfits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('outfit_id');
            $table->foreign('outfit_id')->references('id')->on('outfits');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags');
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
        Schema::dropIfExists('tag_outfits');
    }
}
