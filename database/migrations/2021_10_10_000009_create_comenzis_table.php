<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComenzisTable extends Migration
{
    public function up()
    {
        Schema::create('comenzis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data_init');
            $table->string('nume_client');
            $table->string('pers_contact');
            $table->string('telefon');
            $table->string('adresa');
            $table->string('cost_total')->nullable();
            $table->string('cost_lunar')->nullable();
            $table->string('numar_comanda');
            $table->string('numar_ariba')->nullable();
            $table->longText('observatii')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
