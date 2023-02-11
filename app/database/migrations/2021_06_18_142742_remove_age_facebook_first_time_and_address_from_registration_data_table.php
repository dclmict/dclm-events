<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAgeFacebookFirstTimeAndAddressFromRegistrationDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registration_data', function (Blueprint $table) {
            //
            $table->dropColumn(['address', 'age', 'facebook_username', 'new_comer']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registration_data', function (Blueprint $table) {
            //
        });
    }
}
