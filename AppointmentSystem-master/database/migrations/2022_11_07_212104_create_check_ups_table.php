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
        // Schema::create('check_ups', function (Blueprint $table) {
        //     $table->id();
        //     $table->bigInteger('service_id')->unsigned();
        //     $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
        //     $table->string('checkup')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_ups');
    }
};
