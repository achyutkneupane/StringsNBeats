<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name')->nullable();
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('summary')->nullable();
            $table->unsignedBigInteger('artist_id')->nullable();
            $table->unsignedBigInteger('album_id')->nullable();
            $table->date('released_at')->nullable();
            $table->text('lyrics')->nullable();
            $table->string('youtube')->nullable();
            $table->string('noodle')->nullable();
            $table->string('spotify')->nullable();
            $table->string('logo_link')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->foreign('album_id')->references('id')->on('albums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
