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
        Schema::create('gangas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('url');
            $table->bigInteger('likes')->default(0);
            $table->bigInteger('unlikes')->default(0);
            $table->decimal('price')->unsigned();
            $table->decimal('price_sale')->unsigned();
            $table->boolean('available');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('photo');
            $table->timestamps();
            $table->foreign("user_id")->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gangas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->dropForeign('user_id');
        });
    }
};
