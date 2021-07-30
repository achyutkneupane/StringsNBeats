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
            $table->unsignedBigInteger('album_id')->nullable();
            $table->date('recorded_at')->nullable();
            $table->date('released_at')->nullable();
            $table->text('lyrics_np')->nullable();
            $table->text('lyrics_en')->nullable();
            $table->string('composer')->nullable();
            $table->string('arranger')->nullable();
            $table->string('lyricist')->nullable();
            $table->string('genre')->nullable();
            $table->string('duration')->nullable();
            $table->string('isrcCode')->nullable();
            $table->string('youtube')->nullable();
            $table->string('noodle')->nullable();
            $table->string('spotify')->nullable();
            $table->string('logo_link')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreign('album_id')->references('id')->on('albums');
        });
        Schema::create('artist_song', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artist_id')->nullable();
            $table->unsignedBigInteger('song_id')->nullable();
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->foreign('song_id')->references('id')->on('songs');
            $table->timestamps();
        });
        Schema::create('article_song', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id')->nullable();
            $table->unsignedBigInteger('song_id')->nullable();
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('song_id')->references('id')->on('songs');
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
        Schema::dropIfExists('songs');
    }
}
