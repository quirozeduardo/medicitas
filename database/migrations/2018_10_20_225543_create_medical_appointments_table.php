<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_appointments',function (Blueprint $table){
            $table->increments('id');
            $table->dateTime('datetime');
            $table->integer('patient_id')->unsigned();
            $table->integer('doctor_id')->unsigned();
            $table->integer('medical_consultant_id')->unsigned()->nullable(true);
            $table->integer('medical_appointment_status_id')->unsigned();
            $table->string('comments',512)->nullable(true);
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('medical_consultant_id')->references('id')->on('medical_consultants')->onDelete('set null');
            $table->foreign('medical_appointment_status_id')->references('id')->on('medical_appointment_states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_appointments');
    }
}
