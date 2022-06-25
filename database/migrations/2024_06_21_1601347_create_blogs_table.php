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
        Schema::create('blogs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
            $table->string('content', 10000);
            $table->string('link', 300);

            $table->string('keyword1', 50)->nullable();
            $table->string('keyword2', 50)->nullable();
            $table->string('keyword3', 50)->nullable();
            $table->string('keyword4', 50)->nullable();
            $table->string('keyword5', 50)->nullable();

            $table->string('category_id', 100)->nullable();

            $table->timestamps();
        });
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreign('keyword1')->references('id')->on('keywords');
            $table->foreign('keyword2')->references('id')->on('keywords');
            $table->foreign('keyword3')->references('id')->on('keywords');
            $table->foreign('keyword4')->references('id')->on('keywords');
            $table->foreign('keyword5')->references('id')->on('keywords');
            $table->foreign('category_id')->references('id')->on('blogcategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
