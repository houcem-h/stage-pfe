<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Stage
        Schema::create('internships', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('type',['init','perf','pfe']);
            $table->unsignedInteger('framer')->nullable();//encadreur
            $table->unsignedInteger('company_framer');//encadreur societé
            $table->enum('state',['waiting','accepted','rejected'])->default('waiting');
            $table->timestamps();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('student')->references('id')->on('registrations');
            $table->foreign('framer')->references('id')->on('users');
            $table->foreign('company_framer')->references('id')->on('managers');
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
        Schema::dropIfExists('internships');
    }
}
