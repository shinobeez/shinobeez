<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('appointment_id')->nullable();
            $table->string('user_contactnumber')->nullable();
            $table->foreign('user_contactnumber')->references('contactnumber')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
            $table->string('appointment_services')->nullable();
            // $table->string('appointment_category')->nullable();
            $table->string('appointment_vaccine_category')->nullable();
            $table->string('appointment_vaccine_type')->nullable();
            // $table->string('appointment_covid_dose')->nullable();
            // $table->string('appointment_medicine')->nullable();
            $table->string('appointment_concern')->nullable();
            // $table->string('appointment_information')->nullable();
            $table->string('appointment_message')->nullable();
            $table->integer('appointment_queue')->default(0);
            $table->integer('appointment_availableslot')->nullable();
            $table->date('appointment_date')->nullable();
            $table->dateTime('appointment_expiration_date')->nullable();
            // $table->string('appointment_expired')->default("no");
            $table->string('appointment_status')->default("pending");
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
        Schema::dropIfExists('appointments');
    }
};
