<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('ganga_id')->unsigned();
            $table->boolean('vote');
            $table->foreign("user_id")->references('id')->on('users');
            $table->foreign("ganga_id")->references('id')->on('gangas');


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
        Schema::table('votos', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->dropForeign('user_id');
            $table->foreign('ganga_id')->references('id')->on('gangas')->onDelete('cascade');
            $table->dropForeign('ganga_id');
        });
    }
};
