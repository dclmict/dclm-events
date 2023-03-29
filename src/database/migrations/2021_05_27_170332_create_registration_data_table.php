<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_data', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 50);
            $table->string('email', 100)->nullable();
            $table->string('age', 10);
            $table->enum('gender', ['Male', 'Female']);
            $table->string('address', 255);

            $table->string('phone_number', 20)->nullable();

            $table->string('whatsapp_number', 20)->nullable();

            $table->string('facebook_username', 50)->nullable();
            $table->string('church', 50)->nullable();
            $table->enum('new_comer', ['Yes', 'No']);

            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('id')->on('programs');

            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->nullable();

            $table->string('state');
            $table->string('lga');

            // $table->unsignedBigInteger('state_id');
            // $table->foreign('state_id')->references('id')->on('states')->nullable();

            // $table->unsignedBigInteger('region_id');
            // $table->foreign('region_id')->references('id')->on('regions')->nullable();

            // $table->unsignedBigInteger('group_id');
            // $table->foreign('group_id')->references('id')->on('groups')->nullable();

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
        Schema::dropIfExists('registration_data');
    }
}
