<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReqframerToInternship extends Migration
{
  /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
        Schema::table('internships',function ($table)
        {
        $table->integer('reqframer')->nullable();
        }
      );
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
        Schema::table('internships',function ($table)
        {
        $table->dropColumn('reqframer');
      });
      }
}
