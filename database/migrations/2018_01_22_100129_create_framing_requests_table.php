<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFramingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('framing_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('internship');
            $table->unsignedInteger('teacher');
            $table->enum('request_type',['request','wish']);
            $table->enum('status',['waiting','accepeted','rejected'])->default('waiting');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('internship')->references('id')->on('internships');
            $table->foreign('teacher')->references('id')->on('users');
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
        Schema::dropIfExists('framing_requests');
    }
}
