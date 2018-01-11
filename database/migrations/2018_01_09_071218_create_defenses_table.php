<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Soutenances
        Schema::create('defenses', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_d');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('classroom');
            $table->unsignedInteger('internship');
            $table->unsignedInteger('reporter');
            $table->unsignedInteger('president');
            $table->timestamps();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('internship')->references('id')->on('internships');
            $table->foreign('reporter')->references('id')->on('users');
            $table->foreign('president')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('defenses');
    }
}
