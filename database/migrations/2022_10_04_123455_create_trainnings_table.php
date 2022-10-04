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
        Schema::create('trainnings', function (Blueprint $table) {
           
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->integer('duration');
            $table->double('amount');
            $table->double('first_slice');
            $table->double('second_slice');
            $table->double('third_slice');
            $table->string('short_description');
            $table->string('long_description')->nullable();
            $table->string('trainning_photo_path')->nullable();
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
        Schema::dropIfExists('trainnings');
    }
};
