<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserSubscriptionsIndexForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_user', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('subscription_id');
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
            $table->dropIndex(['user_id', 'subscription_id']); // Drops index 'geo_state_index'
        });
    }
}
