<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeYoutubeTypeInArtists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->string('tiktok')->nullable()->after('twitter');
            $table->string('nickname')->nullable()->after('name');
            $table->boolean('active')->default(true)->after('founded_at');
            $table->text('summary')->nullable()->after('description');
            $table->string('genre')->nullable()->after('summary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            //
        });
    }
}
