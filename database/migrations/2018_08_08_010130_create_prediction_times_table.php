<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePredictionTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prediction_times', function (Blueprint $table) {
            $table->integer('prediction_id')->unsigned();
            $table->dateTime('time');
            $table->float('value');

            $table->foreign('prediction_id')
                ->references('id')
                ->on('predictions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prediction_times');
    }
}
