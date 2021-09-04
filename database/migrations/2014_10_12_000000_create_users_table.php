<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('reset_password_token')->nullable();
            $table->timestamp('reset_password_expired')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('google_id')->nullable()->default('null');
            $table->string('email_verified_control')->nullable();
            $table->string('email_verified_success')->nullable()->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
