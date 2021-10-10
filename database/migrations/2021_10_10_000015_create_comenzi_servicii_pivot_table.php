<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComenziServiciiPivotTable extends Migration
{
    public function up()
    {
        Schema::create('comenzi_servicii', function (Blueprint $table) {
            $table->unsignedBigInteger('comenzi_id');
            $table->foreign('comenzi_id', 'comenzi_id_fk_3926870')->references('id')->on('comenzis')->onDelete('cascade');
            $table->unsignedBigInteger('servicii_id');
            $table->foreign('servicii_id', 'servicii_id_fk_3926870')->references('id')->on('serviciis')->onDelete('cascade');
        });
    }
}
