<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvsContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evs_contents', function (Blueprint $table) {
            $table->id();
            $table->string('option_name');
            $table->string('option_value')->nullable();
            $table->string('type')->nullable();
            $table->text('meta')->nullable();
            $table->timestamps();
        });
        DB::table('evs_contents')->insert([
            // Event Category
            ['option_name' => 'event_category', 'option_value' => 'Services' ,'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_category', 'option_value' => 'Crusades', 'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_category', 'option_value' => 'Retreats', 'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_category', 'option_value' => 'Youth Conference', 'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_category', 'option_value' => 'Workers Conference', 'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_category', 'option_value' => 'Leaders Conference', 'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_category', 'option_value' => 'Special Occasion', 'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_category', 'option_value' => 'Revival Program', 'type' => NULL,'meta' => NULL],

            // Event type
            ['option_name' => 'event_type', 'option_value' => 'Monday Bible Study', 'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_type', 'option_value' => 'Tuesday Leaders Development', 'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_type', 'option_value' => 'Workers Training', 'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_type', 'option_value' => 'Global Crusade with Kumuyi', 'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_type', 'option_value' => 'December Retreat', 'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_type', 'option_value' => 'Easter Retreat', 'type' => NULL,'meta' => NULL],
            ['option_name' => 'event_type', 'option_value' => 'Leadership Strategy Congress', 'type' => NULL,'meta' => NULL],

        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evs_contents');
    }
}
