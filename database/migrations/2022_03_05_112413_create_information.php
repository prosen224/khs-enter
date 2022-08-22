<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table){
            $table->id();
            $table->date('date');
            $table->integer('technician_id');
            $table->integer('client_id');
            $table->integer('typeofwork_id');
            $table->integer('hours');
            $table->integer('minutes');
            $table->integer('billable');
            $table->string('billed_info');
            $table->string('payment_info');
            $table->longText('details');
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
        Schema::dropIfExists('information');
    }
}
