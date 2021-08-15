<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNevTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nev', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->longtext('description');
            $table->integer('hit')->default('0');
            $table->integer('status')->default('0')->comment('0:pasif 1:aktif');
            $table->string('slug');
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
        Schema::dropIfExists('nev');
    }
}
