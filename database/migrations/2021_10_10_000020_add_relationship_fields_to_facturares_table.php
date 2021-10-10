<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFacturaresTable extends Migration
{
    public function up()
    {
        Schema::table('facturares', function (Blueprint $table) {
            $table->unsignedBigInteger('numar_comanda_id');
            $table->foreign('numar_comanda_id', 'numar_comanda_fk_3926894')->references('id')->on('comenzis');
        });
    }
}
