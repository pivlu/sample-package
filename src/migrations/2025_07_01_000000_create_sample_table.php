<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleTable extends Migration
{
   public function up()
   {
      Schema::create('sample_table', function (Blueprint $table) {
         $table->id();
         $table->string('name');
         $table->timestamps();
      });
   }

   public function down()
   {
      Schema::dropIfExists('sample_table');
   }
}