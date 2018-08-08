<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePredictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partner_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('scale_id')->unsigned();
            $table->date('date');
            $table->integer('threshold')->default(1);

            $table->foreign('partner_id')
                ->references('id')
                ->on('partners');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities');

            $table->foreign('scale_id')
                ->references('id')
                ->on('scales');

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
        Schema::dropIfExists('predictions');
    }
}
