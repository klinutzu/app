<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciisTable extends Migration
{
    public function up()
    {
        Schema::create('serviciis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serviciu');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
