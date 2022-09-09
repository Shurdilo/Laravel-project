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
        Schema::create('parohije', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('paroh');
            $table->string('paroh_phone');
            $table->string('paroh_email');
            $table->string('paroh_image');
            $table->text('about');
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
        Schema::dropIfExists('parohije');
    }
};
