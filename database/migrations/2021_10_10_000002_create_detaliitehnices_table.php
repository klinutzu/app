<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetaliitehnicesTable extends Migration
{
    public function up()
    {
        Schema::create('detaliitehnices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('link_monitorizare')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
