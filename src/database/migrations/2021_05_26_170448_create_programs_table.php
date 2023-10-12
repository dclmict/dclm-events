<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->boolean('is_active')->default(true);
            $table->string('image_location')->nullable();
            $table->enum('event_type', ['Global', 'Local'])->nullable();
            $table->string('category')->nullable();
            $table->string('event_days')->nullable();
            $table->string('event_month')->nullable();
            $table->string('event_date')->nullable();
            $table->string('event_countdown')->nullable();
            $table->text('schedules')->nullable();

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
        Schema::dropIfExists('programs');
    }
}
