<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboratoryAnalisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->nullable(false)->default(0);
            $table->integer('patient_id')->unsigned();
            $table->dateTime('arrived_analysis_date')->nullable(false);
            $table->unsignedInteger('type_analisis_id')->nullable(false);

            $table->foreign('type_analisis_id')->references('id')->on('type_analisis')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

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
        Schema::dropIfExists('laboratory_analisis');
    }
}
