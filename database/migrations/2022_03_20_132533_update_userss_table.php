<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Subscription;

class UpdateUserssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('discount_balance')->nullable()->after('remember_token');
            // $table->foreignIdFor(Subscription::class)->constrained()->default(0)->after('discount_balance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['subscription_id']);
        });*/
    }
}
