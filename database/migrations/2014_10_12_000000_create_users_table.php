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
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('referral_code');
            $table->string('referred_by');
            $table->rememberToken();
            $table->softDeletes(); // <-- This will add a deleted_at field
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

        Schema::table('subscription_user', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'subscription_id']); // Drops index 'geo_state_index'
        });

        Schema::dropIfExists('users');
    }
}
