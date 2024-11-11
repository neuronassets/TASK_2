<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailingTable extends Migration
{
    public function up()
    {
        Schema::create('mailing', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique(); // This is the 'email' column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mailing');
    }
}
