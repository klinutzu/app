<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstalarisTable extends Migration
{
    public function up()
    {
        Schema::create('instalaris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip')->nullable();
            $table->string('user')->nullable();
            $table->string('parola')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
