<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meetId')->comment("Meeting ID RELATION");
            $table->boolean('isRepeat')->comment('Repeating Meeting');
            $table->dateTime('start')->comment("Meeting Date");
            $table->time('duration')->comment("Meeting Duration");
            $table->integer('repDays')->nullable()->comment("Repeated Days");
            $table->timestamps();

            $table->foreign('meetId')->references('id')->on('meetings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
