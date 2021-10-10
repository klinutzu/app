<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDetaliitehnicesTable extends Migration
{
    public function up()
    {
        Schema::table('detaliitehnices', function (Blueprint $table) {
            $table->unsignedBigInteger('numar_comanda_id');
            $table->foreign('numar_comanda_id', 'numar_comanda_fk_3926887')->references('id')->on('comenzis');
            $table->unsignedBigInteger('detalii_tehnice_id');
            $table->foreign('detalii_tehnice_id', 'detalii_tehnice_fk_3926892')->references('id')->on('instalaris');
        });
    }
}
